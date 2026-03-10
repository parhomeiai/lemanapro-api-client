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
            __DIR__ . '/../../config/lemanapro-api-client.php', 'lemanapro-api-client'
        );

        $this->app->singleton(LemanaProApiClient::class, function () {

            $environment = config('lemanapro-api-client.environment', 'production');

            return LemanaProApiClientFactory::make(
                config('lemanapro-api-client.client_id', ''),
                config('lemanapro-api-client.client_secret', ''),
                [
                    'timeout'        => config('lemanapro-api-client.http.timeout'),
                    'retry_times'    => config('lemanapro-api-client.http.retry.times'),
                    'retry_sleep_ms' => config('lemanapro-api-client.http.retry.sleep_ms'),
                    'base_url' => config('lemanapro-api-client.environments.' . $environment . '.base_url'),
                    'token_url' => config('lemanapro-api-client.environments.' . $environment . '.auth_url'),
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