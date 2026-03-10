<?php

namespace Escorp\LemanaProApiClient\Dto\Parcels;

use Escorp\LemanaProApiClient\Exceptions\DtoMappingException;

/**
 * Данные для отмены отправления
 */
class ParcelCancelDto
{
    /**
     * ID отправления
     * @var string
     */
    public string $parcelId;

    /**
     * Статус в котором производится отмена
     * @var string
     */
    public string $stage;

    /**
     * Причина отмены
     * @var string
     */
    public string $reason;

    /**
     *
     * @param string $parcelId
     * @param string $stage
     * @param string $reason
     */
    function __construct(string $parcelId, string $stage, string $reason) {
        $this->parcelId = $parcelId;
        $this->stage = $stage;
        $this->reason = $reason;
    }

                /**
     *
     * @param array $data
     * @return self
     * @throws DtoMappingException
     */
    public static function fromArray(array $data): self
    {
        foreach (['parcelId','stage', 'reason'] as $key) {
            if (!array_key_exists($key, $data)) {
                throw new DtoMappingException("ParcelCancelDto: missing field '{$key}'");
            }
        }

        return new self(
            (string)$data['parcelId'],
            (string)$data['stage'],
            (string)$data['reason']
        );
    }
    
    public function toArray(): array
    {
        return array_filter([
            'parcelId' => $this->parcelId,
            'stage' => $this->stage,
            'reason' => $this->reason
        ], fn($v) => $v !== null);
    }
}
