<?php

namespace Escorp\LemanaProApiClient\Dto\Logistic;

use Escorp\LemanaProApiClient\Exceptions\DtoMappingException;

/**
 * Адрес логистической локации
 */
class LogisticLocationAddressDto
{
    /**
     * Почтовый индекс
     * @var string
     */
    public string $logisticLocationPostalCode;

    /**
     * Страна
     * @var string
     */
    public string $logisticLocationCountryName;

    /**
     * Регион
     * @var string
     */
    public string $logisticLocationRegionName;

    /**
     * Населенный пункт
     * @var string
     */
    public string $logisticLocationCityName;

    /**
     * Улица
     * @var string
     */
    public string $logisticLocationStreet;

    /**
     * Дом
     * @var string
     */
    public string $logisticLocationHouse;

    /**
     * Часовой пояс
     * @var int
     */
    public int $logisticLocationTimeZone;

    /**
     * Идентификатор географического полигона
     *
     * @var int|null
     */
    public ?int $logisticLocationGeoGeometry;

    /**
     * Полный адрес
     * @var string
     */
    public string $logisticLocationAddressOneLine;


    function __construct(string $logisticLocationPostalCode, string $logisticLocationCountryName, string $logisticLocationRegionName, string $logisticLocationCityName, string $logisticLocationStreet, string $logisticLocationHouse, int $logisticLocationTimeZone, ?int $logisticLocationGeoGeometry, string $logisticLocationAddressOneLine) {
        $this->logisticLocationPostalCode = $logisticLocationPostalCode;
        $this->logisticLocationCountryName = $logisticLocationCountryName;
        $this->logisticLocationRegionName = $logisticLocationRegionName;
        $this->logisticLocationCityName = $logisticLocationCityName;
        $this->logisticLocationStreet = $logisticLocationStreet;
        $this->logisticLocationHouse = $logisticLocationHouse;
        $this->logisticLocationTimeZone = $logisticLocationTimeZone;
        $this->logisticLocationGeoGeometry = $logisticLocationGeoGeometry;
        $this->logisticLocationAddressOneLine = $logisticLocationAddressOneLine;
    }

        /**
     *
     * @param array $data
     * @return self
     * @throws DtoMappingException
     */
    public static function fromArray(array $data): self
    {
        foreach (['logisticLocationPostalCode','logisticLocationCountryName', 'logisticLocationRegionName', 'logisticLocationCityName', 'logisticLocationStreet', 'logisticLocationHouse', 'logisticLocationTimeZone', 'logisticLocationGeoGeometry', 'logisticLocationAddressOneLine'] as $key) {
            if (!array_key_exists($key, $data)) {
                throw new DtoMappingException("LogisticLocationAddressDto: missing field '{$key}'");
            }
        }

        return new self(
            (string)$data['logisticLocationPostalCode'],
            (string)$data['logisticLocationCountryName'],
            (string)$data['logisticLocationRegionName'],
            (string)$data['logisticLocationCityName'],
            (string)$data['logisticLocationStreet'],
            (string)$data['logisticLocationHouse'],
            (int)$data['logisticLocationTimeZone'],
            ($data['logisticLocationTimeZone'] !== null) ? (int)$data['logisticLocationTimeZone'] : null,
            (int)$data['logisticLocationAddressOneLine'],
        );
    }
}
