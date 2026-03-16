<?php

namespace Escorp\LemanaProApiClient\Dto\Stocks;

use Escorp\LemanaProApiClient\Exceptions\DtoMappingException;

/**
 * Ошибка обновления остатка
 */
class StockErrorDto
{
    /**
     * Код ошибки, INVALID_ITEMS или DUPLICATED_ITEMS
     * @var string
     */
    public string $code;

    /**
     *
     * @var int
     */
    public int $productBUReferences;

    /**
     *
     * @param string $code
     * @param int $productBUReferences
     */
    function __construct(string $code, int $productBUReferences) {
        $this->code = $code;
        $this->productBUReferences = $productBUReferences;
    }

    /**
     *
     * @param array $data
     * @return self
     * @throws DtoMappingException
     */
    public static function fromArray(array $data): self
    {
        return new self(
            isset($data['code']) ? (string)$data['code'] : '',
            isset($data['productBUReferences']) ? (int)$data['productBUReferences'] : 0
        );
    }

}
