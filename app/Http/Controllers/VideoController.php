<?php

namespace App\Http\Controllers;

use App\Models\Transcriptions;
use App\Models\Translations;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */



     
public function store(Request $request)
{
    Log::info(' Received video upload request');

    try {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'original_language' => 'required|string|max:10',
            'target_language' => 'nullable|string|max:10',
            'video' => 'required|mimes:mp4,mov,avi|max:2048000',
        ]);

        $path = $request->file('video')->store('videos', 'public');

        $video = Video::create([
            'title' => $request->title,
            'original_language' => $request->original_language,
            'target_language' => $request->target_language,
            'video_path' => $path,
            'user_id' => auth()->id(),
            'status' => 'uploaded',
        ]);

        Log::info(' Video saved', $video->toArray());

        $flaskPayload = [
            'video_path' => asset("storage/" . $video->video_path),
            'language' => $video->original_language,
            'video_id' => $video->id, 
                ];

Log::info(' Received video upload request');
Log::info(' Sending to Flask API', $flaskPayload);

try {
    $client = new \GuzzleHttp\Client(['timeout' => 5]); 

    $client->postAsync('http://127.0.0.1:5000/api/transcribe', [
        'json' => $flaskPayload
    ])->wait(); 
} catch (\Exception $e) {
    Log::error(' Error while calling Flask API (non-blocking)', ['error' => $e->getMessage()]);
}


 $transcriptions = $video->transcriptions()->get(['start_time', 'end_time', 'text', 'language']);

return response()->json([
    'id' => $video->id,  
    'title' => $video->title,
    'original_language' => $video->original_language,
    'status' => $video->status,
    'video_path' => $video->video_path,

]);

    } catch (\Illuminate\Validation\ValidationException $e) {
        Log::error(' Validation Error', $e->errors());
        return response()->json(['errors' => $e->errors()], 422);

    } catch (\Exception $e) {
        Log::error(' General Error', ['message' => $e->getMessage()]);
        return response()->json(['error' => $e->getMessage()], 500);
    }
}



   public function save(Request $request)
{
    Log::info('Transcription received', $request->all());

    $validated = $request->validate([
        'video_id' => 'required|integer',
        'segments' => 'required|array',
    ]);

    foreach ($validated['segments'] as $segment) {
        try {
    
        $transcription = Transcriptions::create([
        'video_id' => $request->video_id,
        'start_time' => $segment['start'],
        'end_time' => $segment['end'],
        'text' => $segment['text'],
        'language' => $segment['language'],
    ]);

    if (!empty($segment['translated_text'])) {
        Translations::create([
            'video_id' => $request->video_id,
            'transcription_id' => $transcription->id,
            'translated_text' => $segment['translated_text'],
            'language' => $segment['target_language'] ?? 'N/A',
        ]); 
   
Log::info('Translation saved', [
    'video_id' => $request->video_id,
    'transcription_id' => $transcription->id,
    'translated_text' => $segment['translated_text'],
]);

    }

   if ($request->has('processed_video_path')) {
    $video = Video::find($request->video_id);
    if ($video) {
        $cleanPath = str_replace('storage/app/public/', '', $request->processed_video_path);
        $video->processed_video_path = $cleanPath;
        $video->save();
    }
}


        } catch (\Exception $e) {
            Log::error("Failed to save segment: " . $e->getMessage());
        }
    }



    return response()->json(['message' => 'Transcription saved']);
}



 



    public function history(Video $video)
    {
    
    $videos = Video::where('user_id', auth()->id())->latest()->get();
    return view('history', compact('videos'));

    }


    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {

    abort_if($video->user_id !== auth()->id(), 403);

    $video->load(['transcriptions', 'translations', 'voiceOvers', 'activities']);

    return view('show', compact('video'));


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Video $video)
{
    $title = $video->title; 

    $video->delete();

    return redirect()->back()->with("success", "Your video '$title' has been deleted.");
}


}
