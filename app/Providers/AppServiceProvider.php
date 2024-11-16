<?php

namespace App\Providers;

use App\Interfaces\ImageStorage;
use App\Util\ImageLocalStorage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(ImageStorage::class, ImageLocalStorage::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //require base_path('routes/breadcrumbs.php');
    }
}
