<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class theme extends Model
{

        public function user() {
    return $this->belongsTo(User::class);
}


        protected $fillable = [
        
                'mode',
                'user_id',
        
        ];

}
