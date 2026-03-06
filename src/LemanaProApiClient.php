<?php

namespace Escorp\LemanaProApiClient;

use Escorp\LemanaProApiClient\Api\Logistic\LogisticApi;
use Escorp\LemanaProApiClient\Api\Parcels\ParcelsApi;

class LemanaProApiClient
{
    public LogisticApi $logisticApi;

    public ParcelsApi $parcelsApi;

    public function __construct(
            LogisticApi $logisticApi,
            ParcelsApi $parcelsApi
    ) {
        $this->logisticApi = $logisticApi;
        $this->parcelsApi = $parcelsApi;
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

    /**
     * Возвращает объект для работы с отправлениями
     *
     * @return ParcelsApi
     */
    public function parcelsApi(): ParcelsApi
    {
        return $this->parcelsApi;
    }
}