<?php

declare(strict_types=1);

namespace Escorp\LemanaProApiClient\Factory;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\HttpFactory;
use Psr\Http\Client\ClientInterface;

use Escorp\LemanaProApiClient\Auth\ClientCredentialsTokenProvider;
use Escorp\LemanaProApiClient\Http\GuzzleHttpClient;
use Escorp\LemanaProApiClient\Http\Psr18HttpClient;
use Escorp\LemanaProApiClient\LemanaProApiClient;

use Escorp\LemanaProApiClient\Api\Logistic\LogisticApi;

final class LemanaProApiClientFactory
{
    /**
     * Создание клиента
     *
     * @param string $clientId
     * @param string $clientSecret
     * @param array{
     *   timeout?: int,
     *   retry_times?: int,
     *   retry_sleep_ms?: int,
     *   base_url?: string,
     *   token_url?: string
     * } $options
     * @param ClientInterface|null $psr18Client
     * @return LemanaProApiClient
     */
    public static function make(string $clientId, string $clientSecret, array $options = [], ?ClientInterface $psr18Client = null): LemanaProApiClient
    {
        $timeout = $options['timeout'] ?? 10;
        $retryTimes = $options['retry_times'] ?? 3;
        $retrySleepMs = $options['retry_sleep_ms'] ?? 300;
        $baseUrl = $options['base_url'] ?? null;
        $tokenUrl = $options['token_url'] ?? null;

        if ($psr18Client === null) {
            // дефолтный Guzzle → PSR-18 адаптер
            $psr18Client = new GuzzleClient(['timeout' => $timeout]);
        }

        $http = new Psr18HttpClient(
            $psr18Client,
            new HttpFactory(),
            new HttpFactory()
        );

        //retry-обертка поверх PSR-18
        $guzzleHttpClient = new GuzzleHttpClient($http, $retryTimes, $retrySleepMs);

        // Token provider
        $tokenProvider = new ClientCredentialsTokenProvider($guzzleHttpClient, $clientId, $clientSecret, $tokenUrl);


        //Domain API
        $logisticApi = new LogisticApi($guzzleHttpClient, $tokenProvider, $baseUrl);

        //Root client
        return new LemanaProApiClient(
                    $logisticApi,
                );
    }
}

