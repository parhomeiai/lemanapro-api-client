<?php

namespace Escorp\LemanaProApiClient\Dto\Prices;

use Escorp\LemanaProApiClient\Exceptions\DtoMappingException;

/**
 * Информация о новой продажной цене
 */
class SalesPriceValueDto
{
    /**
     *
     * @var string
     */
    private string $salesPriceValueInConsumerUnitId;

    /**
     *
     * @var float
     */
    private float $salesPriceValueInConsumerUnitValue;

    /**
     *
     * @param string $salesPriceValueInConsumerUnitId
     * @param float $salesPriceValueInConsumerUnitValue
     */
    function __construct(string $salesPriceValueInConsumerUnitId, float $salesPriceValueInConsumerUnitValue) {
        $this->salesPriceValueInConsumerUnitId = $salesPriceValueInConsumerUnitId;
        $this->salesPriceValueInConsumerUnitValue = $salesPriceValueInConsumerUnitValue;
    }

    /**
     *
     * @param array $data
     * @return self
     * @throws DtoMappingException
     */
    public static function fromArray(array $data): self
    {
        foreach (['salesPriceValueInConsumerUnitId','salesPriceValueInConsumerUnitValue'] as $key) {
            if (!array_key_exists($key, $data)) {
                throw new DtoMappingException("SalesPriceValueDto: missing field '{$key}'");
            }
        }

        return new self(
            (string)$data['salesPriceValueInConsumerUnitId'],
            (float)$data['salesPriceValueInConsumerUnitValue'],
        );
    }

    /**
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'salesPriceValueInConsumerUnitId' => $this->salesPriceValueInConsumerUnitId,
            'salesPriceValueInConsumerUnitValue' => $this->salesPriceValueInConsumerUnitValue,
        ], fn($v) => $v !== null);
    }

    function getSalesPriceValueInConsumerUnitId(): string {
        return $this->salesPriceValueInConsumerUnitId;
    }

    function getSalesPriceValueInConsumerUnitValue(): float {
        return $this->salesPriceValueInConsumerUnitValue;
    }

    function setSalesPriceValueInConsumerUnitId(string $salesPriceValueInConsumerUnitId): void {
        $this->salesPriceValueInConsumerUnitId = $salesPriceValueInConsumerUnitId;
    }

    function setSalesPriceValueInConsumerUnitValue(float $salesPriceValueInConsumerUnitValue): void {
        $this->salesPriceValueInConsumerUnitValue = $salesPriceValueInConsumerUnitValue;
    }

}
