<?php

namespace Escorp\LemanaProApiClient\Dto\Logistic;

use Escorp\LemanaProApiClient\Exceptions\DtoMappingException;

/**
 * Description of LogisticLocationsDto
 *
 * @author parhomey
 */
class LogisticLocationsDto
{
    /**
     * Идентификатор логистической локации
     * @var string
     */
    public string $logisticLocationId;

    /**
     * Тип логистической локации
     * @var string
     * Value: "MERCHANT_WAREHOUSE"
     */
    public string $logisticLocationType;

    /**
     * Адрес логистической локации
     * @var LogisticLocationAddressDto
     */
    public LogisticLocationAddressDto $logisticLocationAddress;

    /**
     * Статус логистической локации
     * Enum: "DRAFT" "ENABLED" "DISABLED"
     * @var string
     */
    public string $status;

    /**
     * Название логистической локации
     * @var string
     */
    public string $name;


    function __construct(string $logisticLocationId, string $logisticLocationType, LogisticLocationAddressDto $logisticLocationAddress, string $status, string $name) {
        $this->logisticLocationId = $logisticLocationId;
        $this->logisticLocationType = $logisticLocationType;
        $this->logisticLocationAddress = $logisticLocationAddress;
        $this->status = $status;
        $this->name = $name;
    }

        /**
     *
     * @param array $data
     * @return self
     * @throws DtoMappingException
     */
    public static function fromArray(array $data): self
    {
        foreach (['logisticLocationId','logisticLocationType', 'logisticLocationAddress', 'status', 'name'] as $key) {
            if (!array_key_exists($key, $data)) {
                throw new DtoMappingException("LogisticLocationsDto: missing field '{$key}'");
            }
        }

        $types = [];
        foreach ($data['types'] ?? [] as $type) {
            $types[] = NewsTypesDto::fromArray($type);
        }

        return new self(
            (string)$data['logisticLocationId'],
            (string)$data['logisticLocationType'],
            LogisticLocationAddressDto::fromArray($data['logisticLocationAddress']),
            (string)$data['status'],
            (string)$data['name'],
        );
    }
}
