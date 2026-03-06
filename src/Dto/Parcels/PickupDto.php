<?php

namespace Escorp\LemanaProApiClient\Dto\Parcels;

use Escorp\LemanaProApiClient\Exceptions\DtoMappingException;

/**
 * Description of ParcelsDto
 */
class PickupDto
{
    /**
     * Идентификатор сервиса доставки
     * @var int
     */
    public int $deliveryServiceId;

    /**
     * Наименование сервиса доставки
     * @var string
     */
    public string $deliveryServiceName;

    /**
     * Идентификатор склада
     * @var string
     */
    public string $logisticLocationId;

    /**
     * Дата отгрузки
     * @var string
     */
    public string $pickupDate;

    /**
     * Временной интервал отгрузки
     * @var string
     */
    public string $timeInterval;

    function __construct(int $deliveryServiceId, string $deliveryServiceName, string $logisticLocationId, string $pickupDate, string $timeInterval) {
        $this->deliveryServiceId = $deliveryServiceId;
        $this->deliveryServiceName = $deliveryServiceName;
        $this->logisticLocationId = $logisticLocationId;
        $this->pickupDate = $pickupDate;
        $this->timeInterval = $timeInterval;
    }

    /**
     *
     * @param array $data
     * @return self
     * @throws DtoMappingException
     */
    public static function fromArray(array $data): self
    {
        foreach (['deliveryServiceId','deliveryServiceName', 'logisticLocationId', 'pickupDate', 'timeInterval'] as $key) {
            if (!array_key_exists($key, $data)) {
                throw new DtoMappingException("PickupDto: missing field '{$key}'");
            }
        }

        return new self(
            (int)$data['deliveryServiceId'],
            (string)$data['deliveryServiceName'],
            (string)$data['logisticLocationId'],
            (string)$data['pickupDate'],
            (string)$data['timeInterval'],
        );
    }
}
