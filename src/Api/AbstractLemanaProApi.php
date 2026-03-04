<?php

namespace Escorp\LemanaProApiClient\Api;

use Escorp\LemanaProApiClient\Contracts\HttpClientInterface;
use Escorp\LemanaProApiClient\Contracts\TokenProviderInterface;

/**
 * Базовый класс для всех Domain API
 *
 * @author parhomey
 */
abstract class AbstractLemanaProApi
{
    protected HttpClientInterface $http;
    protected TokenProviderInterface $token;

    protected string $baseUrl;

    /**
     *
     * @param HttpClientInterface $http
     * @param TokenProviderInterface $token
     * @param string|null $baseUrl
     */
    public function __construct(
        HttpClientInterface $http,
        TokenProviderInterface $token,
        ?string $baseUrl = null)
    {
        $this->http = $http;
        $this->token = $token;

        $this->baseUrl = ($baseUrl) ? ($baseUrl) : ('https://api.lemanapro.ru:443');
    }

    /**
     * Выполняет запрос, подставляет токен
     *
     * @param string $method
     * @param string $url
     * @param array $options
     * @return array
     */
    protected function request(string $method, string $url, array $options = []): array
    {
        if(!isset($options['headers']['Authorization'])){
            $options['headers']['Authorization'] = $this->token->getToken();
        }

        $response = $this->http->request($method, $url, $options);

        return $response;
    }
}
