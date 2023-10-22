<?php

namespace App\Providers;

use App\Jobs\AddFilm;
use app\src\FilmService;
use app\src\ImportRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
//        $this->app->bind(AddFilm::class, function ($app) {
//            return new AddFilm($app->make('ImportRepository'));
//        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
