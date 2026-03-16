<?php

namespace Escorp\LemanaProApiClient\Dto\Prices;

use Escorp\LemanaProApiClient\Dto\LemanaProApiResponseDto;

/**
 * Ответ на запрос Метод для загрузки продажных цен
 *
 * Используется в endpoint:
 * GET https://api.lemanapro.ru:443/prices/merchant-price/v1/seller-sales-prices:upload
 */
class UploadSellerSalesPricesResponse extends LemanaProApiResponseDto
{
    public array $salesPriceErrors = [];

    public static function fromArray(array $response): self
    {
        $lemanaProApiResponseDto = parent::fromArray($response);

        $dto = new self($lemanaProApiResponseDto->data);

        if(isset($response['salesPriceErrors'])){
            foreach ($response['salesPriceErrors'] as $item) {
                $dto->salesPriceErrors[] = SalesPriceErrorDto::fromArray($item);
            }
        }

        return $dto;
    }

    /**
     * Возвращает ошибки обновления цен
     * @return array
     */
    public function salesPriceErrors(): array
    {
        return $this->salesPriceErrors;
    }
}
