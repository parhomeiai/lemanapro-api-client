<?php

namespace Escorp\LemanaProApiClient\Dto\Stocks;

use Escorp\LemanaProApiClient\Dto\LemanaProApiResponseDto;

/**
 * Ответ на запрос Получение информации об остатках на складах мерчанта
 *
 * Используется в endpoint:
 * GET https://api.lemanapro.ru:443/stocks/stock-repository-merchants/v1/merchant-stocks:search
 */
class StocksSearchResponse extends LemanaProApiResponseDto
{
    public string $logisticLocationId;

    public array $stocks = [];

    public static function fromArray(array $response): self
    {
        $lemanaProApiResponseDto = parent::fromArray($response);

        $dto = new self($lemanaProApiResponseDto->data);

        $dto->logisticLocationId = $response['logisticLocationId'] ?? '';

        if(isset($response['stock'])){
            foreach ($response['stock'] as $item) {
                $dto->stocks[] = StockDto::fromArray($item);
            }
        }

        return $dto;
    }

    /**
     * Возвращает остатки
     * @return array
     */
    public function stocks(): array
    {
        return $this->stocks;
    }
}
