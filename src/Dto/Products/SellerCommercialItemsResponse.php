<?php

namespace Escorp\LemanaProApiClient\Dto\Products;

use Escorp\LemanaProApiClient\Dto\LemanaProApiResponseDto;

/**
 * Ответ на запрос Поиск товаров по заданным параметрам
 *
 * Используется в endpoint:
 * GET https://api.lemanapro.ru:443/products/sellers-commercial/v1/seller-commercial-items
 */
class SellerCommercialItemsResponse extends LemanaProApiResponseDto
{
    public array $items = [];

    public int $page = 0;

    public int $pageSize = 0;

    public int $totalCount = 0;

    public static function fromArray(array $response): self
    {
        $lemanaProApiResponseDto = parent::fromArray($response);

        $dto = new self($lemanaProApiResponseDto->data);

        $items = $response['sellerCommercialItems'] ?? [];

        foreach ($items as $item) {
            $dto->items[] = SellerCommercialItemDto::fromArray($item);
        }

        $dto->page = $response['page'] ?? 0;
        $dto->pageSize = $response['pageSize'] ?? 0;
        $dto->totalCount = $response['totalCount'] ?? 0;

        return $dto;
    }

    /**
     * Возвращает товары
     * @return array
     */
    public function items(): array
    {
        return $this->items;
    }
}
