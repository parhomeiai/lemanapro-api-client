<?php

namespace Escorp\LemanaProApiClient\Api\Products;

use Escorp\LemanaProApiClient\Api\AbstractLemanaProApi;

use Escorp\LemanaProApiClient\Dto\Products\SellerCommercialItemsResponse;


/**
 * Товары
 * API для получения основной информации о товарах
 */
class ProductsApi extends AbstractLemanaProApi
{

    /**
     * Метод возвращает список всех товаров с основной информацией по ним
     * @param array $commercialItemBuReference
     * @param int $page
     * @param int $perPage
     * @param bool $withTotalCount
     * @return SellerCommercialItemsResponse
     */
    public function getSellerCommercialItems(array $commercialItemBuReference = [], int $page = 0, int $perPage = 50, bool $withTotalCount = false): SellerCommercialItemsResponse
    {
        $url = $this->baseUrl . '/products/sellers-commercial/v1/seller-commercial-items';

        $query = [
            'page' => $page,
            'perPage' => $perPage,
            'withTotalCount' => $withTotalCount ? 'true' : 'false'
        ];

        if(!empty($commercialItemBuReference)){
            $query['commercialItemBuReference'] = $commercialItemBuReference;
        }

        $response = $this->request('GET', $url, [
            'query'   => $query,
        ]);

        return SellerCommercialItemsResponse::fromArray($response);
    }

    /**
     * Возвращает список всех товаров с основной информацией по ним
     * @param array $commercialItemBuReference
     * @return SellerCommercialItemDto[]
     */
    public function getSellerCommercialItemsBatch(array $commercialItemBuReference = []): array
    {
        $page = 1;
        $perPage = 50;

        $result = [];

        do{
            $response = $this->getSellerCommercialItems($commercialItemBuReference, $page, $perPage);

            if(empty($response->items)){
                break;
            }

            foreach ($response->items as $sellerCommercialItemDto) {
                $result[] = $sellerCommercialItemDto;
            }

            $page++;
            usleep(600_000);
        }while(true);

        return $result;
    }
}
