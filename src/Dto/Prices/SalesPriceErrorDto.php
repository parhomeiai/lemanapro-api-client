<?php

namespace Escorp\LemanaProApiClient\Dto\Prices;

use Escorp\LemanaProApiClient\Exceptions\DtoMappingException;

/**
 * Информация об ошибке
 */
class SalesPriceErrorDto
{
    /**
     * Идентификатор товара, продаваемого компанией Лемана Про (например, 1P, 3P, услуга и т.д.)
     * @var string
     */
    public string $commercialItemBuReference;

    /**
     * Локация
     * @var LocationDto
     */
    public LocationDto $location;

    /**
     * Сообщение об ошибке
     * @var string
     */
    public string $errorMessage;

    /**
     *
     * @param string $commercialItemBuReference
     * @param LocationDto $location
     * @param string $errorMessage
     */
    function __construct(string $commercialItemBuReference, LocationDto $location, string $errorMessage) {
        $this->commercialItemBuReference = $commercialItemBuReference;
        $this->location = $location;
        $this->errorMessage = $errorMessage;
    }

        /**
     *
     * @param array $data
     * @return self
     * @throws DtoMappingException
     */
    public static function fromArray(array $data): self
    {
        foreach (['commercialItemBuReference','location', 'errorMessage'] as $key) {
            if (!array_key_exists($key, $data)) {
                throw new DtoMappingException("SalesPriceErrorDto: missing field '{$key}'");
            }
        }

        return new self(
            (string)$data['commercialItemBuReference'],
            LocationDto::fromArray($data['location']),
            (string)$data['errorMessage'],
        );
    }

}
