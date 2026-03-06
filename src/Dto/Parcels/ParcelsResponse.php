<?php

namespace Escorp\LemanaProApiClient\Dto\Parcels;

use Escorp\LemanaProApiClient\Dto\LemanaProApiResponseDto;

/**
 * Ответ на запрос Получение информации об отправлениях
 *
 * Используется в endpoint:
 * GET https://api.lemanapro.ru:443/orders/merchants/v1/parcels
 */
class ParcelsResponse extends LemanaProApiResponseDto
{
    public array $parcels = [];

    public static function fromArray(array $response): self
    {
        $lemanaProApiResponseDto = parent::fromArray($response);

        $dto = new self($lemanaProApiResponseDto->data);

        foreach ($response as $item) {
            $dto->parcels[] = ParcelDto::fromArray($item);
        }

        return $dto;
    }

    /**
     * Возвращает отправления
     * @return array
     */
    public function parcels(): array
    {
        return $this->parcels;
    }
}
