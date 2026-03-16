<?php

namespace Escorp\LemanaProApiClient;

use Escorp\LemanaProApiClient\Api\Logistic\LogisticApi;
use Escorp\LemanaProApiClient\Api\Parcels\ParcelsApi;
use Escorp\LemanaProApiClient\Api\Products\ProductsApi;
use Escorp\LemanaProApiClient\Api\Prices\PricesApi;

class LemanaProApiClient
{
    public LogisticApi $logisticApi;

    public ParcelsApi $parcelsApi;

    public ProductsApi $productsApi;

    public PricesApi $pricesApi;

    public function __construct(
            LogisticApi $logisticApi,
            ParcelsApi $parcelsApi,
            ProductsApi $productsApi,
            PricesApi $pricesApi
    ) {
        $this->logisticApi = $logisticApi;
        $this->parcelsApi = $parcelsApi;
        $this->productsApi = $productsApi;
        $this->pricesApi = $pricesApi;
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

    /**
     * Возвращает объект для работы с товарами
     *
     * @return ProductsApi
     */
    public function productsApi(): ProductsApi
    {
        return $this->productsApi;
    }

    /**
     * Возвращает объект для работы с ценами
     *
     * @return PricesApi
     */
    public function pricesApi(): PricesApi
    {
        return $this->pricesApi;
    }
}