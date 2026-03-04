<?php

namespace Escorp\LemanaProApiClient\Laravel;

use Escorp\LemanaProApiClient\LemanaProApiClient;
use Escorp\LemanaProApiClient\Factory\LemanaProApiClientFactory;
use Illuminate\Support\ServiceProvider;

class LemanaProApiClientServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/lemanapro-api-client.php', 'wb-api-client'
        );

        $this->app->singleton(LemanaProApiClient::class, function () {
            return LemanaProApiClientFactory::make(
                config('lemanapro-api-client.api_key'),
                [
                    'timeout'        => config('lemanapro-api-client.http.timeout'),
                    'retry_times'    => config('lemanapro-api-client.http.retry.times'),
                    'retry_sleep_ms' => config('lemanapro-api-client.http.retry.sleep_ms'),
                ]
            );
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/lemanapro-api-client.php' =>
                config_path('lemanapro-api-client.php'),
        ], 'lemanapro-api-client-config');
    }
}