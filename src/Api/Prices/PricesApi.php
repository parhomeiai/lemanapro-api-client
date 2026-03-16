<?php

namespace Escorp\LemanaProApiClient\Api\Prices;

use Escorp\LemanaProApiClient\Api\AbstractLemanaProApi;

use Escorp\LemanaProApiClient\Dto\Prices\SalesPriceDto;
use Escorp\LemanaProApiClient\Dto\Prices\UploadSellerSalesPricesResponse;

/**
 * Цены
 * API для обновления цен
 */
class PricesApi extends AbstractLemanaProApi
{

    /**
     * Загрузка продажных цен
     * @param array $salesPrices
     * @return UploadSellerSalesPricesResponse
     * @throws InvalidArgumentException
     */
    public function uploadSellerSalesPrices(array $salesPrices): UploadSellerSalesPricesResponse
    {
        foreach ($salesPrices as $s) {
            if (!$s instanceof SalesPriceDto) {
                throw new InvalidArgumentException('salesPrices must contain SalesPriceDto');
            }
        }

        $url = $this->baseUrl . '/prices/merchant-price/v1/seller-sales-prices:upload';

        $response = $this->request('POST', $url, [
            'json'   => [
                'salesPrices' => array_map(function(SalesPriceDto $salesPriceDto){return $salesPriceDto->toArray();}, $salesPrices)
            ],
        ]);

        return UploadSellerSalesPricesResponse::fromArray($response);
    }
}
