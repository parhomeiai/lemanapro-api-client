<?php

namespace Escorp\LemanaProApiClient\Dto\Products;

use Escorp\LemanaProApiClient\Exceptions\DtoMappingException;

/**
 * Товар
 */
class SellerCommercialItemDto
{

    public array $data;

    /**
     * Уникальный идентификатор партнера в системе
     * @var int
     */
    public ?int $sellerIdentifier;

    /**
     * Код категории товара
     * @var string
     */
    public ?string $productModelCategoryIdentifier;

    /**
     * ЛМ код товара
     * @var string
     */
    public ?string $commercialItemBuReference;

    /**
     * Уникальный идентификатор товара в системе партнера.
     * @var string
     */
    public ?string $sellerCommercialItemIdentifier;

    /**
     * Артикул товара
     * @var string
     */
    public ?string $commercialItemManufacturerIdentifier;

    /**
     * Классификация товара, принятая в компании. Используется для определения товара к определенной группе в зависимости от его функциональности, назначения и характеристик.
     * @var string
     */
    public ?string $commercialItemNomenclatureCode;

    /**
     * GTIN товара - глобальный номер товарной продукции в единой международной базе товаров. Числовое представление штрих кода товара.
     * @var string
     */
    public ?string $commercialItemGTIN;

    /**
     * Длинное наименование товара. В некоторых случаях может содержать различные характеристики товара.
     * @var string
     */
    public ?string $commercialItemLongDesignation;

    /**
     * Статус товара от момента первичной загрузки в систему, до момента вывода на маркетплейс или архивации.
     * @var string
     */
    public ?string $commercialItemStatus;

    /**
     * Тип продукта, в текущей версии всегда принимает значение 'product'.
     * @var string
     */
    public ?string $commercialItemType;


    function __construct(array $data, ?int $sellerIdentifier, ?string $productModelCategoryIdentifier, ?string $commercialItemBuReference, ?string $sellerCommercialItemIdentifier, ?string $commercialItemManufacturerIdentifier, ?string $commercialItemNomenclatureCode, ?string $commercialItemGTIN, ?string $commercialItemLongDesignation, ?string $commercialItemStatus, ?string $commercialItemType) {
        $this->data = $data;
        $this->sellerIdentifier = $sellerIdentifier;
        $this->productModelCategoryIdentifier = $productModelCategoryIdentifier;
        $this->commercialItemBuReference = $commercialItemBuReference;
        $this->sellerCommercialItemIdentifier = $sellerCommercialItemIdentifier;
        $this->commercialItemManufacturerIdentifier = $commercialItemManufacturerIdentifier;
        $this->commercialItemNomenclatureCode = $commercialItemNomenclatureCode;
        $this->commercialItemGTIN = $commercialItemGTIN;
        $this->commercialItemLongDesignation = $commercialItemLongDesignation;
        $this->commercialItemStatus = $commercialItemStatus;
        $this->commercialItemType = $commercialItemType;
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
            $data,
            isset($data['sellerIdentifier']) ? (int)$data['sellerIdentifier'] : null,
            isset($data['productModelCategoryIdentifier']) ? (string)$data['productModelCategoryIdentifier'] : null,
            isset($data['commercialItemBuReference']) ? (string)$data['commercialItemBuReference'] : null,
            isset($data['sellerCommercialItemIdentifier']) ? (string)$data['sellerCommercialItemIdentifier'] : null,
            isset($data['commercialItemManufacturerIdentifier']) ? (string)$data['commercialItemManufacturerIdentifier'] : null,
            isset($data['commercialItemNomenclatureCode']) ? (string)$data['commercialItemNomenclatureCode'] : null,
            isset($data['commercialItemGTIN']) ? (string)$data['commercialItemGTIN'] : null,
            isset($data['commercialItemLongDesignation']) ? (string)$data['commercialItemLongDesignation'] : null,
            isset($data['commercialItemStatus']) ? (string)$data['commercialItemStatus'] : null,
            isset($data['commercialItemType']) ? (string)$data['commercialItemType'] : null,
        );
    }
}
