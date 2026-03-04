<?php

namespace Escorp\LemanaProApiClient\Auth;

use Escorp\LemanaProApiClient\Contracts\TokenProviderInterface;

/**
 * Статический токен
 */
final class StaticTokenProvider implements TokenProviderInterface
{
    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Возвращает токен
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }
}
