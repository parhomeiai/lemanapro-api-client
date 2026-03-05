<?php

namespace Escorp\LemanaProApiClient\Dto\Logistic;

use Escorp\LemanaProApiClient\Dto\LemanaProApiResponseDto;

/**
 * Ответ на запрос Получение информации о логистических локациях конкретного владельца
 *
 * Используется в endpoint:
 * GET https://api.lemanapro.ru:443/locations/logistic-location-public/v1/logistic-locations
 */
class LocationsResponse extends LemanaProApiResponseDto
{
    public array $logisticLocations = [];

    public int $page = 0;

    public int $pageSize = 0;

    public int $totalCount = 0;

    public static function fromArray(array $response): self
    {
        $lemanaProApiResponseDto = parent::fromArray($response);

        $dto = new self($lemanaProApiResponseDto->data);

        $items = $response['logisticLocations'] ?? [];

        foreach ($items as $item) {
            $dto->logisticLocations[] = LogisticLocationsDto::fromArray($item);
        }

        $dto->page = $response['page'] ?? 0;
        $dto->pageSize = $response['pageSize'] ?? 0;
        $dto->totalCount = $response['totalCount'] ?? 0;

        return $dto;
    }

    /**
     * Возвращает локации
     * @return array
     */
    public function logisticLocations(): array
    {
        return $this->logisticLocations;
    }
}
