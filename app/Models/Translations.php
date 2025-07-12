<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Translations extends Model{

protected $fillable = [
    'video_id',
    'transcription_id',
    'translated_text',
    'language',
];


    public function user() {
    return $this->belongsTo(User::class);
}

public function transcription() {
    return $this->belongsTo(Transcriptions::class);
}

}
