<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Video;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

public function boot()
{

        Route::middleware("api")
        ->prefix('api')
        ->group(base_path('routes/api.php'));    


    View::composer('*', function ($view) {
        if (auth()->check()) {
            $userVideos = Video::where('user_id', auth()->id())->latest()->get();
            $view->with('userVideos', $userVideos);
        }
    });


}

}
