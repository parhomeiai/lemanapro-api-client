<?php

namespace Escorp\LemanaProApiClient\Dto\Parcels;

use Escorp\LemanaProApiClient\Exceptions\DtoMappingException;

/**
 * Акт приема-передачи
 */
class AcceptanceReportDto
{
    /**
     * ID документа АПП ( акта приема-передачи )
     * @var string
     */
    public string $acceptanceReportId;

    /**
     * ID отправлений
     * @var string[]
     */
    public array $parcelIds;


    function __construct(string $acceptanceReportId, array $parcelIds)
    {
        $this->acceptanceReportId = $acceptanceReportId;
        $this->parcelIds = $parcelIds;
    }

        /**
     *
     * @param array $data
     * @return self
     * @throws DtoMappingException
     */
    public static function fromArray(array $data): self
    {
        foreach (['acceptanceReportId','parcelIds'] as $key) {
            if (!array_key_exists($key, $data)) {
                throw new DtoMappingException("AcceptanceReportDto: missing field '{$key}'");
            }
        }

        return new self(
            (string)$data['acceptanceReportId'],
            $data['parcelIds'],
        );
    }
}
