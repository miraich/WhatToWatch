<?php

namespace App\Providers;


use App\Support\ImportRepository;
use App\Support\RemoteRepository;
use Illuminate\Support\ServiceProvider;
use Psr\Http\Client\ClientInterface;

class FilmServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ImportRepository::class, RemoteRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
