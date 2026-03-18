<?php

namespace Escorp\LemanaProApiClient\Dto\Parcels;

use Escorp\LemanaProApiClient\Exceptions\DtoMappingException;

/**
 * Товар в грузовом месте
 */
class ProductBoxeDto
{
    /**
     * Артикул товара. Номер артикула товара в Маркетплейсе
     * @var string
     */
    public string $productBUReference;

    /**
     * Количество товара в коробке
     * @var int
     */
    public int $quantity;

    /**
     * Номер грузоместа в отправлении
     * @var int
     */
    public int $placeNumber;

    /**
     * Количество грузомест в отправлении всего
     * @var int
     */
    public int $placeTotal;

    /**
     *
     * @param string $productBUReference
     * @param int $quantity
     * @param int $placeNumber
     * @param int $placeTotal
     */
    function __construct(string $productBUReference, int $quantity, int $placeNumber, int $placeTotal) {
        $this->productBUReference = $productBUReference;
        $this->quantity = $quantity;
        $this->placeNumber = $placeNumber;
        $this->placeTotal = $placeTotal;
    }

        /**
     *
     * @param array $data
     * @return self
     * @throws DtoMappingException
     */
    public static function fromArray(array $data): self
    {
        foreach (['productBUReference','quantity', 'placeNumber', 'placeTotal'] as $key) {
            if (!array_key_exists($key, $data)) {
                throw new DtoMappingException("ProductBoxeDto: missing field '{$key}'");
            }
        }

        return new self(
            (string)$data['productBUReference'],
            (int)$data['quantity'],
            (int)$data['placeNumber'],
            (int)$data['placeTotal'],
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
            'quantity' => $this->quantity,
            'placeNumber' => $this->placeNumber,
            'placeTotal' => $this->placeTotal
        ], fn($v) => $v !== null);
    }

    function getProductBUReference(): string {
        return $this->productBUReference;
    }

    function getQuantity(): int {
        return $this->quantity;
    }

    function getPlaceNumber(): int {
        return $this->placeNumber;
    }

    function getPlaceTotal(): int {
        return $this->placeTotal;
    }

    function setProductBUReference(string $productBUReference): void {
        $this->productBUReference = $productBUReference;
    }

    function setQuantity(int $quantity): void {
        $this->quantity = $quantity;
    }

    function setPlaceNumber(int $placeNumber): void {
        $this->placeNumber = $placeNumber;
    }

    function setPlaceTotal(int $placeTotal): void {
        $this->placeTotal = $placeTotal;
    }


}
