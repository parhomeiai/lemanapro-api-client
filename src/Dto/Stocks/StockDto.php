<?php

namespace Escorp\LemanaProApiClient\Dto\Stocks;

use Escorp\LemanaProApiClient\Exceptions\DtoMappingException;

/**
 * Остатки
 */
class StockDto
{
    /**
     * Артикул товара (код ЛМ).Числовое значение, длина 6–8 символов
     * @var int
     */
    private int $productBUReference;

    /**
     * Общий сток
     * @var float
     */
    private float $stockTheoreticalQuantity;

    /**
     * Зарезервированный сток
     * @var float
     */
    private float $stockReservedQuantity;

    /**
     * Доступный для продажи сток
     * @var float
     */
    private float $stockAvailableForSaleQuantity;


    function __construct(int $productBUReference, float $stockTheoreticalQuantity, float $stockReservedQuantity, float $stockAvailableForSaleQuantity) {
        $this->productBUReference = $productBUReference;
        $this->stockTheoreticalQuantity = $stockTheoreticalQuantity;
        $this->stockReservedQuantity = $stockReservedQuantity;
        $this->stockAvailableForSaleQuantity = $stockAvailableForSaleQuantity;
    }

    /**
     *
     * @param array $data
     * @return self
     * @throws DtoMappingException
     */
    public static function fromArray(array $data): self
    {
        foreach (['productBUReference','stockTheoreticalQuantity', 'stockReservedQuantity', 'stockAvailableForSaleQuantity'] as $key) {
            if (!array_key_exists($key, $data)) {
                throw new DtoMappingException("StockDto: missing field '{$key}'");
            }
        }

        return new self(
            (int)$data['productBUReference'],
            (float)$data['stockTheoreticalQuantity'],
            (float)$data['stockReservedQuantity'],
            (float)$data['stockAvailableForSaleQuantity']
        );
    }

    /**
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'productBUReference' => $this->productBUReference,
            'stockTheoreticalQuantity' => $this->stockTheoreticalQuantity
        ], fn($v) => $v !== null);
    }
}
