<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{


protected $fillable = ['title', 'video_path', 'user_id','original_language','status','target_language'];


public function transcriptions() {
    return $this->hasMany(Transcriptions::class);
}

public function translations() {
     return $this->hasMany(Translations::class,"video_id");

}

public function voiceOvers() {
    return $this->hasMany(VoiceOvers::class,'videos_id');
}



public function activities() {
    return $this->hasMany(Activity::class,'video_id');
}


public function user() {
    return $this->belongsTo(User::class);
}

 
}
