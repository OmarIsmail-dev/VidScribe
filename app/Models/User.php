<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function theme() {
    return $this->hasOne(Theme::class);
}

public function activities() {
    return $this->hasMany(Activity::class);
}

public function transcriptions() {
    return $this->hasMany(Transcriptions::class);
}

public function translations() {
    return $this->hasMany(Translations::class);
}
public function videos() {
    return $this->hasMany(Video::class);
}

public function voiceOvers() {
    return $this->hasMany(VoiceOvers::class);
}


}



