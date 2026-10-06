<?php

namespace App\Providers;

use App\Contracts\DockerClientInterface;
use App\Services\DockerClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            DockerClientInterface::class,
            fn () => new DockerClient(
                socket: config('docker-manager.docker.socket'),
                apiVersion: config(
                    'docker-manager.docker.api_version'
                ),
            ),
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
