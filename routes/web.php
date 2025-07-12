<?php

use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view("auth.login");
});

Auth::routes();


Route::middleware(['auth'])->group(function () {
    

Route::get('/phpinfo', function () {
    phpinfo();
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/Logout', [App\Http\Controllers\HomeController::class, 'Logout'])->name('Logout');

Route::post('/Mode', [App\Http\Controllers\HomeController::class, 'Mode'])->name('Mode');

Route::post('/videos', [VideoController::class, 'store'])->name('videos');

// Route::post('/api/transcription/save', [VideoController::class, 'save']);

//  Route::post('/transcription/save', [VideoController::class, 'save']);

Route::get('/history', [VideoController::class, 'history'])->name('history');
Route::get('/delete/{video}', [VideoController::class, 'destroy'])->name('delete');


 Route::get('/{video}', [VideoController::class, 'show'])->name('show');

 });