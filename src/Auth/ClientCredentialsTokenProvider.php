<?php

namespace Escorp\LemanaProApiClient\Auth;

use Escorp\LemanaProApiClient\Contracts\TokenProviderInterface;
use Escorp\LemanaProApiClient\Contracts\HttpClientInterface;

/**
 * OAuth2 client_credentials
 */
final class ClientCredentialsTokenProvider implements TokenProviderInterface
{
    private const DEFAULT_TOKEN_URL = 'https://partners.auth.lemanapro.ru/realms/partner/protocol/openid-connect/token';

    /** @var HttpClientInterface */
    private HttpClientInterface $httpClient;

    /** @var string */
    private $clientId;

    /** @var string */
    private $clientSecret;

    /** @var string */
    private $authUrl;

    /** @var int */
    private $leewaySeconds;

    /** @var string|null */
    private $accessToken = null;

    /** @var int */
    private $expiresAt = 0;

    /**
     *
     * @param HttpClientInterface $httpClient
     * @param string $clientId
     * @param string $clientSecret
     * @param string|null $authUrl
     * @param int $leewaySeconds
     */
    public function __construct(
        HttpClientInterface $httpClient,
        string $clientId,
        string $clientSecret,
        ?string $authUrl = null,
        int $leewaySeconds = 10
    ) {
        $this->httpClient = $httpClient;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->authUrl = ($authUrl) ? ($authUrl) : (self::DEFAULT_TOKEN_URL);
        $this->leewaySeconds = $leewaySeconds;
    }

    /**
     * Проверяет срок действия токена
     *
     * @return bool
     */
    private function isTokenValid(): bool
    {
        if (!$this->accessToken || !$this->expiresAt) {
            return false;
        }

        return time() < $this->expiresAt;
    }

    /**
     * Возвращает токен
     *
     * @return string
     */
    public function getToken(): string
    {
        if (!$this->isTokenValid()) {
            $this->refreshToken();
        }

        return 'Bearer ' . $this->accessToken;
    }

    /**
     * Обновляет токен
     *
     * @return void
     * @throws \RuntimeException
     */
    private function refreshToken(): void
    {
        $response = $this->httpClient->request(
            'POST',
            $this->authUrl,
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                ],
            ]
        );

        if (!isset($response['access_token'])) {
            throw new \RuntimeException('LemanaPro OAuth: access_token not found in response');
        }

        $this->accessToken = $response['access_token'];
        $this->expiresAt = time() + (int)($response['expires_in'] ?? 300) - $this->leewaySeconds;
    }
}
