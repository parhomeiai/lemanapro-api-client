<?php

namespace Escorp\LemanaProApiClient\Dto\Prices;

use Escorp\LemanaProApiClient\Exceptions\DtoMappingException;

/**
 * Локация цены
 */
class LocationDto
{
    /**
     * Идентификатор географической зоны, в которой действует цена
     * @var int
     */
    private int $locationId;

    /**
     * Тип местоположения Enum: "BUSINESS_UNIT" "PRICE_ZONE"
     * @var string
     */
    private string $locationType;

    function __construct(int $locationId, string $locationType) {
        $this->locationId = $locationId;
        $this->locationType = $locationType;
    }

            /**
     *
     * @param array $data
     * @return self
     * @throws DtoMappingException
     */
    public static function fromArray(array $data): self
    {
        foreach (['locationId','locationType'] as $key) {
            if (!array_key_exists($key, $data)) {
                throw new DtoMappingException("LocationDto: missing field '{$key}'");
            }
        }

        return new self(
            (int)$data['locationId'],
            (string)$data['locationType'],
        );
    }

    /**
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'locationId' => $this->locationId,
            'locationType' => $this->locationType,
        ], fn($v) => $v !== null);
    }

    function setLocationId(int $locationId): void
    {
        $this->locationId = $locationId;
    }

    function setLocationType(string $locationType): void
    {
        $this->locationType = $locationType;
    }

    function getLocationId(): int
    {
        return $this->locationId;
    }

    function getLocationType(): string
    {
        return $this->locationType;
    }

}
