<?php

namespace Escorp\LemanaProApiClient\Dto\Parcels;

use Escorp\LemanaProApiClient\Exceptions\DtoMappingException;

/**
 * Товар в заказе
 */
class ProductDto
{
    /**
     * Уникальный идентификатор продукта
     * @var string
     */
    public string $productBUReference;

    /**
     * Код производителя
     * @var string
     */
    public string $vendorCode;

    /**
     * Стоимость продукта
     * @var float
     */
    public float $salesPriceValueInConsumerUnitValue;

    /**
     * Количество
     * @var int
     */
    public int $qty;

    /**
     * Комиссия
     * @var float
     */
    public float $comissionRate;

    function __construct(string $productBUReference, string $vendorCode, float $salesPriceValueInConsumerUnitValue, int $qty, float $comissionRate) {
        $this->productBUReference = $productBUReference;
        $this->vendorCode = $vendorCode;
        $this->salesPriceValueInConsumerUnitValue = $salesPriceValueInConsumerUnitValue;
        $this->qty = $qty;
        $this->comissionRate = $comissionRate;
    }

        /**
     *
     * @param array $data
     * @return self
     * @throws DtoMappingException
     */
    public static function fromArray(array $data): self
    {
        foreach (['productBUReference','vendorCode', 'salesPriceValueInConsumerUnitValue', 'qty', 'comissionRate'] as $key) {
            if (!array_key_exists($key, $data)) {
                throw new DtoMappingException("ProductDto: missing field '{$key}'");
            }
        }

        return new self(
            (string)$data['productBUReference'],
            (string)$data['vendorCode'],
            (float)$data['salesPriceValueInConsumerUnitValue'],
            (int)$data['qty'],
            (float)$data['comissionRate'],
        );
    }

    /**
     * Уникальный идентификатор продукта
     * @return string
     */
    function getProductBUReference(): string {
        return $this->productBUReference;
    }

    /**
     * Код производителя
     * @return string
     */
    function getVendorCode(): string {
        return $this->vendorCode;
    }

    /**
     * Стоимость продукта
     * @return float
     */
    function getSalesPriceValueInConsumerUnitValue(): float {
        return $this->salesPriceValueInConsumerUnitValue;
    }

    /**
     * Количество
     * @return int
     */
    function getQty(): int {
        return $this->qty;
    }

    /**
     * Комиссия
     * @return float
     */
    function getComissionRate(): float {
        return $this->comissionRate;
    }
}
