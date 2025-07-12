<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * المسارات المستثناة من التحقق من CSRF.
     *
     * @var array<int, string>
     */
    protected $except = [
        '/api/transcription/save', // ✅ دي المسار المهم لحل مشكلة 419
    ];
}
