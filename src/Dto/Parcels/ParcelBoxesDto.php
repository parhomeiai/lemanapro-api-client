<?php

namespace Escorp\LemanaProApiClient\Dto\Parcels;

use Escorp\LemanaProApiClient\Exceptions\DtoMappingException;

/**
 * Грузоместа отправления
 */
class ParcelBoxesDto
{
    /**
     * Индентификатор коробки
     * @var string
     */
    public string $id;

    /**
     * Грузоместа
     * @var array
     */
    public array $products;

    /**
     *
     * @param string $id
     * @param array $products
     */
    function __construct(string $id, array $products)
    {
        foreach ($products as $p) {
            if (!$p instanceof ProductBoxeDto) {
                throw new \InvalidArgumentException('products must contain ProductBoxeDto');
            }
        }

        $this->id = $id;
        $this->products = $products;
    }

    /**
     *
     * @param array $data
     * @return self
     * @throws DtoMappingException
     */
    public static function fromArray(array $data): self
    {
        foreach (['id','products'] as $key) {
            if (!array_key_exists($key, $data)) {
                throw new DtoMappingException("ParcelBoxesDto: missing field '{$key}'");
            }
        }

        $products = [];

        foreach($data['products'] as $product){
            $products[] = ProductBoxeDto::fromArray($product);
        }

        return new self(
            (string)$data['id'],
            $products,
        );
    }

    public function toArray(): array
    {
        $products = [];

        /**
         * @param ParcelBoxesDto $product
         */
        foreach($this->products as $product){
            $products[] = $product->toArray();
        }

        return [
            'products' => $products,
        ];
    }

    /**
     *
     * @return string
     */
    function getId(): string
    {
        return $this->id;
    }

    /**
     *
     * @return ProductBoxeDto[]
     */
    function getProducts(): array
    {
        return $this->products;
    }

    /**
     *
     * @param string $id
     * @return void
     */
    function setId(string $id): void {
        $this->id = $id;
    }

    /**
     *
     * @param ProductBoxeDto[] $products
     * @return void
     * @throws InvalidArgumentException
     */
    function setProducts(array $products): void {
        foreach ($products as $p) {
            if (!$p instanceof ProductBoxeDto) {
                throw new \InvalidArgumentException('products must contain ProductBoxeDto');
            }
        }

        $this->products = $products;
    }
}
