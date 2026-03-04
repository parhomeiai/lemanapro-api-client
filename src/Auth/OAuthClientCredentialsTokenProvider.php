<?php

namespace Escorp\LemanaProApiClient\Auth;

use Escorp\LemanaProApiClient\Contracts\TokenProviderInterface;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use GuzzleHttp\Psr7\Request;

/**
 * OAuth2 client_credentials
 */
final class OAuthClientCredentialsTokenProvider implements TokenProviderInterface
{
    /** @var ClientInterface */
    private $httpClient;

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

    public function __construct(
        ClientInterface $httpClient,
        string $clientId,
        string $clientSecret,
        string $authUrl,
        int $leewaySeconds = 10
    ) {
        $this->httpClient = $httpClient;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->authUrl = $authUrl;
        $this->leewaySeconds = $leewaySeconds;
    }

    public function getToken(): string
    {
        if ($this->accessToken !== null && time() < $this->expiresAt) {
            return $this->accessToken;
        }

        $this->refreshToken();

        return $this->accessToken;
    }

    private function refreshToken(): void
    {
        $body = http_build_query([
            'grant_type' => 'client_credentials',
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
        ]);

        $request = new Request(
            'POST',
            $this->authUrl,
            [
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept'       => 'application/json',
            ],
            $body
        );

        $response = $this->httpClient->sendRequest($request);

        if ($response->getStatusCode() !== 200) {
            throw new RuntimeException(
                'Failed to obtain access token. Status: ' . $response->getStatusCode()
            );
        }

        $data = json_decode((string) $response->getBody(), true);

        if (!is_array($data) || !isset($data['access_token'], $data['expires_in'])) {
            throw new RuntimeException('Invalid token response');
        }

        $this->accessToken = $data['access_token'];
        $this->expiresAt = time() + (int) $data['expires_in'] - $this->leewaySeconds;
    }
}
