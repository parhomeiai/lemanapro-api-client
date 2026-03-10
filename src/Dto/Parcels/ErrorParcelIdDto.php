<?php

namespace Escorp\LemanaProApiClient\Dto\Parcels;

use Escorp\LemanaProApiClient\Exceptions\DtoMappingException;

/**
 * Отправление с ошибками
 */
class ErrorParcelIdDto
{
    /**
     * ID отправления
     * @var string
     */
    public string $parcelId;

    /**
     * Причина ошибки
     * @var string
     */
    public string $reason;

    /**
     * Код ошибки
     * @var int
     */
    public int $reasonCode;

    function __construct(string $parcelId, string $reason, int $reasonCode) {
        $this->parcelId = $parcelId;
        $this->reason = $reason;
        $this->reasonCode = $reasonCode;
    }

    /**
     *
     * @param array $data
     * @return self
     * @throws DtoMappingException
     */
    public static function fromArray(array $data): self
    {
        foreach (['parcelId','reason', 'reasonCode'] as $key) {
            if (!array_key_exists($key, $data)) {
                throw new DtoMappingException("ErrorParcelIdDto: missing field '{$key}'");
            }
        }

        return new self(
            (string)$data['parcelId'],
            (string)$data['reason'],
            (int)$data['reasonCode'],
        );
    }
}
