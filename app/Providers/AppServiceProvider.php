<?php

namespace App\Providers;

use App\Models\Lesson;
use Illuminate\Support\ServiceProvider;
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
    public function boot(): void
    {
        Route::bind('lesson', function ($value) {
            return Lesson::where('slug', $value)->firstOrFail();
        });
    }
}
