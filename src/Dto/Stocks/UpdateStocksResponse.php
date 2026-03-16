<?php

namespace Escorp\LemanaProApiClient\Dto\Stocks;

use Escorp\LemanaProApiClient\Dto\LemanaProApiResponseDto;

/**
 * Ответ на запрос Загрузка информации о стоках мерчанта
 *
 * Используется в endpoint:
 * POST https://api.lemanapro.ru:443/stocks/stock-repository-merchants/v1/merchant-stocks:update
 */
class UpdateStocksResponse extends LemanaProApiResponseDto
{
    public array $errors = [];

    public static function fromArray(array $response): self
    {
        $lemanaProApiResponseDto = parent::fromArray($response);

        $dto = new self($lemanaProApiResponseDto->data);

        if(isset($response['errors'])){
            foreach ($response['errors'] as $item) {
                $dto->errors[] = StockErrorDto::fromArray($item);
            }
        }

        return $dto;
    }

    /**
     * Возвращает ошибки обновления остатков
     * @return array
     */
    public function errors(): array
    {
        return $this->errors;
    }
}
