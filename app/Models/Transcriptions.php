<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transcriptions extends Model



{

protected $fillable = ['video_id', 'start_time', 'end_time', 'text','language'];

    public function user() {
    return $this->belongsTo(User::class);
}

public function video() {
    return $this->belongsTo(Video::class);
}


}
