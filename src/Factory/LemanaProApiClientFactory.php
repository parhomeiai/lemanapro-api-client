<?php

declare(strict_types=1);

namespace Escorp\LemanaProApiClient\Factory;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\HttpFactory;
use Psr\Http\Client\ClientInterface;

use Escorp\LemanaProApiClient\Auth\StaticTokenProvider;
use Escorp\LemanaProApiClient\Http\GuzzleHttpClient;
use Escorp\LemanaProApiClient\Http\Psr18HttpClient;
use Escorp\LemanaProApiClient\LemanaProApiClient;
use Escorp\LemanaProApiClient\Api\ApiHostRegistry;

final class LemanaProApiClientFactory
{
    /**
     * Создание клиента
     *
     * @param string $token WB API token
     * @param array{
     *   timeout?: int,
     *   retry_times?: int,
     *   retry_sleep_ms?: int
     * } $options
     */
    public static function make(string $token, array $options = [], ?ClientInterface $psr18Client = null): WbApiClient
    {
        $timeout = $options['timeout'] ?? 10;
        $retryTimes = $options['retry_times'] ?? 3;
        $retrySleepMs = $options['retry_sleep_ms'] ?? 300;

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
        $tokenProvider = new StaticTokenProvider($token);

        // Host Registry
        $apiHostRegistry = new ApiHostRegistry();

        //Domain API
//        $pingApi = new PingApi($guzzleHttpClient, $tokenProvider, $apiHostRegistry);
//        $newsApi = new NewsApi($guzzleHttpClient, $tokenProvider, $apiHostRegistry);
//        $sellerApi = new SellerApi($guzzleHttpClient, $tokenProvider, $apiHostRegistry);
//        $inviteApi = new InviteApi($guzzleHttpClient, $tokenProvider, $apiHostRegistry);
//        $usersApi = new UsersApi($guzzleHttpClient, $tokenProvider, $apiHostRegistry);
//        $contentApi = new ContentApi($guzzleHttpClient, $tokenProvider, $apiHostRegistry);
//        $pricesApi = new PricesApi($guzzleHttpClient, $tokenProvider, $apiHostRegistry);
//        $stocksApi = new StocksApi($guzzleHttpClient, $tokenProvider, $apiHostRegistry);
//        $ordersFbsApi = new OrdersFbsApi($guzzleHttpClient, $tokenProvider, $apiHostRegistry);

        //Root client
        return new LemanaProApiClient(
//                    $pingApi,
//                    $newsApi,
//                    $sellerApi,
//                    $inviteApi,
//                    $usersApi,
//                    $contentApi,
//                    $pricesApi,
//                    $stocksApi,
//                    $ordersFbsApi
                );
    }
}

