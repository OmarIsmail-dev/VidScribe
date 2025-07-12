<?php

namespace App\Http\Controllers;

use App\Models\Translations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TranslationsController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Translations $translations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Translations $translations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Translations $translations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Translations $translations)
    {
        //
    }


    public function generateSrtFile($video_id)
{
    $translations = Translations::where('video_id', $video_id)
        ->with('transcription') 
        ->orderBy('transcription_id')
        ->get();

    $srt = "";
    $counter = 1;

    foreach ($translations as $translation) {
        $start = $this->formatSrtTime($translation->transcription->start_time);
        $end = $this->formatSrtTime($translation->transcription->end_time);
        $text = $translation->translated_text;

        $srt .= "$counter\n$start --> $end\n$text\n\n";
        $counter++;
    }

    $filename = "video_{$video_id}.srt";
    Storage::disk('public')->put("subtitles/$filename", $srt);

    $srtPath = asset("storage/subtitles/video_{$video_id}.srt");
dd($srtPath);

    return response()->json([
        'message' => 'SRT file generated',
        'srt_path' => asset("storage/subtitles/$filename"),
    ]);
}

private function formatSrtTime($seconds)
{
    $h = str_pad(floor($seconds / 3600), 2, "0", STR_PAD_LEFT);
    $m = str_pad(floor(($seconds % 3600) / 60), 2, "0", STR_PAD_LEFT);
    $s = str_pad(floor($seconds % 60), 2, "0", STR_PAD_LEFT);
    $ms = str_pad(floor(($seconds - floor($seconds)) * 1000), 3, "0", STR_PAD_RIGHT);
    return "$h:$m:$s,$ms";
}



}
