<?php

namespace Escorp\LemanaProApiClient\Dto\Parcels;

use Escorp\LemanaProApiClient\Exceptions\DtoMappingException;

/**
 * Документ
 */
class DocumentDto
{
    /**
     * Статус готовности документа
     * @var string
     */
    public string $status;

    /**
     * Ссылка на документ
     * @var string|null
     */
    public ?string $fileUrl = null;


    function __construct(string $status, ?string $fileUrl) {
        $this->status = $status;
        $this->fileUrl = $fileUrl;
    }

        /**
     *
     * @param array $data
     * @return self
     * @throws DtoMappingException
     */
    public static function fromArray(array $data): self
    {
        foreach (['status'] as $key) {
            if (!array_key_exists($key, $data)) {
                throw new DtoMappingException("DocumentDto: missing field '{$key}'");
            }
        }

        return new self(
            (string)$data['status'],
            $data['fileUrl'] ?? null
        );
    }
}
