<?php

namespace Escorp\LemanaProApiClient;

use Escorp\LemanaProApiClient\Api\Logistic\LogisticApi;

class LemanaProApiClient
{
    public LogisticApi $logisticApi;

    public function __construct(
            LogisticApi $logisticApi
    ) {
        $this->logisticApi = $logisticApi;
    }

    public function ping(): string
    {
        return 'LemanaPro API client works';
    }

    /**
     * Возвращает объект для получения информации о логистических локациях
     *
     * @return LogisticApi
     */
    public function logisticApi(): LogisticApi
    {
        return $this->logisticApi;
    }
}