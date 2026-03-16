<?php

namespace Escorp\LemanaProApiClient\Dto\Prices;

use Escorp\LemanaProApiClient\Exceptions\DtoMappingException;

/**
 * Цена продажи
 */
class SalesPriceDto
{
    /**
     * Идентификатор товара, продаваемого компанией Лемана Про
     * @var string
     */
    private string $commercialItemBuReference;

    /**
     * Локация
     * @var LocationDto
     */
    private LocationDto $location;

    /**
     * Информация о новой продажной цене
     * @var SalesPriceValueDto
     */
    private SalesPriceValueDto $salesPriceValue;


    function __construct(string $commercialItemBuReference, LocationDto $location, SalesPriceValueDto $salesPriceValue) {
        $this->commercialItemBuReference = $commercialItemBuReference;
        $this->location = $location;
        $this->salesPriceValue = $salesPriceValue;
    }

            /**
     *
     * @param array $data
     * @return self
     * @throws DtoMappingException
     */
    public static function fromArray(array $data): self
    {
        foreach (['commercialItemBuReference','location', 'salesPriceValue'] as $key) {
            if (!array_key_exists($key, $data)) {
                throw new DtoMappingException("SalesPriceDto: missing field '{$key}'");
            }
        }

        return new self(
            (string)$data['commercialItemBuReference'],
            $data['location'],
            $data['salesPriceValue']
        );
    }

    /**
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'commercialItemBuReference' => $this->commercialItemBuReference,
            'location' => $this->location->toArray(),
            'salesPriceValue' => ['salesPriceValueInConsumerUnit' => $this->salesPriceValue->toArray()]
        ], fn($v) => $v !== null);
    }
}
