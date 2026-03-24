<?php

namespace Escorp\LemanaProApiClient\Dto\Parcels;

use Escorp\LemanaProApiClient\Exceptions\DtoMappingException;

use InvalidArgumentException;

/**
 * Description of ParcelDto
 */
class ParcelDto
{
    public array $data;

    /**
     * Уникальный идентификатор отправления
     * @var string
     */
    public string $id;

    /**
     * Дата создания отправления
     * @var string
     */
    public string $creationDate;

    /**
     * Стоимость отправления
     * @var float
     */
    public float $parcelPrice;

    /**
     * Ожидаемая дата доставки
     * @var string
     */
    public string $promisedDeliveryDate;

    /**
     * Стоимость доставки
     * @var float
     */
    public float $deliveryCost;

    /**
     * Информация о доставке
     * @var PickupDto
     */
    public PickupDto $pickup;

    /**
     * Товары в отправлении
     * @var ProductDto[]
     */
    public array $products = [];

    /**
     * Расчетный вес
     * @var float
     */
    public float $calculatedWeight;

    /**
     * Расчетная длина
     * @var float
     */
    public float $calculatedLength;

    /**
     * Расчетная высота
     * @var float
     */
    public float $calculatedHeight;

    /**
     * Расчетная ширина
     * @var float
     */
    public float $calculatedWidth;


    function __construct(array $data, string $id, string $creationDate, float $parcelPrice, string $promisedDeliveryDate, float $deliveryCost, PickupDto $pickup, array $products, float $calculatedWeight, float $calculatedLength, float $calculatedHeight, float $calculatedWidth)
    {
        foreach ($products as $p) {
            if (!$p instanceof ProductDto) {
                throw new InvalidArgumentException('products must contain ProductDto');
            }
        }

        $this->data = $data;
        $this->id = $id;
        $this->creationDate = $creationDate;
        $this->parcelPrice = $parcelPrice;
        $this->promisedDeliveryDate = $promisedDeliveryDate;
        $this->deliveryCost = $deliveryCost;
        $this->pickup = $pickup;
        $this->products = $products;
        $this->calculatedWeight = $calculatedWeight;
        $this->calculatedLength = $calculatedLength;
        $this->calculatedHeight = $calculatedHeight;
        $this->calculatedWidth = $calculatedWidth;
    }

            /**
     *
     * @param array $data
     * @return self
     * @throws DtoMappingException
     */
    public static function fromArray(array $data): self
    {
        foreach (['id','creationDate', 'parcelPrice', 'promisedDeliveryDate', 'deliveryCost', 'pickup', 'products', 'calculatedWeight', 'calculatedLength', 'calculatedHeight', 'calculatedWidth'] as $key) {
            if (!array_key_exists($key, $data)) {
                throw new DtoMappingException("LogisticLocationsDto: missing field '{$key}'");
            }
        }

        $products = [];
        foreach ($data['products'] ?? [] as $product) {
            $products[] = ProductDto::fromArray($product);
        }

        return new self(
            $data,
            (string)$data['id'],
            (string)$data['creationDate'],
            (float)$data['parcelPrice'],
            (string)$data['promisedDeliveryDate'],
            (float)$data['deliveryCost'],
            PickupDto::fromArray($data['pickup']),
            $products,
            (float)$data['calculatedWeight'],
            (float)$data['calculatedLength'],
            (float)$data['calculatedHeight'],
            (float)$data['calculatedWidth'],
        );
    }

    function getData(): array
    {
        return $this->data;
    }

    function getId(): string {
        return $this->id;
    }

    function getCreationDate(): string {
        return $this->creationDate;
    }

    function getParcelPrice(): float {
        return $this->parcelPrice;
    }

    function getPromisedDeliveryDate(): string {
        return $this->promisedDeliveryDate;
    }

    function getDeliveryCost(): float {
        return $this->deliveryCost;
    }

    function getPickup(): PickupDto {
        return $this->pickup;
    }

    function getProducts(): array {
        return $this->products;
    }

    function getCalculatedWeight(): float {
        return $this->calculatedWeight;
    }

    function getCalculatedLength(): float {
        return $this->calculatedLength;
    }

    function getCalculatedHeight(): float {
        return $this->calculatedHeight;
    }

    function getCalculatedWidth(): float {
        return $this->calculatedWidth;
    }

}
