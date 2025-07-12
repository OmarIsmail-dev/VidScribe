<?php

use App\Http\Controllers\TranscriptionsController;
use App\Http\Controllers\TranslationsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;
use App\Models\Transcriptions;
use App\Models\Video;

Route::get('/hello', function () {
    return 'omar';
});


Route::post('/transcription/save', [VideoController::class, 'save']);

Route::get('/generate-srt/{video_id}', [TranslationsController::class, 'generateSrtFile']);


Route::get('/videos/{id}/transcriptions', function ($id) {
    $video = Video::findOrFail($id);
    $transcriptions = $video->transcriptions()->get(['start_time', 'end_time', 'text','language']);

    return response()->json([
        'transcriptions' => $transcriptions,
        'processed_video_path' => $video->processed_video_path,
    ]);

    

});



