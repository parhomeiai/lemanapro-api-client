<?php

namespace Escorp\LemanaProApiClient\Dto\Parcels;

use Escorp\LemanaProApiClient\Exceptions\DtoMappingException;

/**
 * Статус отправления
 */
class ParcelStatusDto
{
    /**
     * Наименование статуса
     * @var string
     */
    public string $name;

    /**
     * Дата получения статуса
     * @var string
     */
    public string $date;


    /**
     *
     * @param string $name
     * @param string $date
     */
    function __construct(string $name, string $date) {
        $this->name = $name;
        $this->date = $date;
    }

        /**
     *
     * @param array $data
     * @return self
     * @throws DtoMappingException
     */
    public static function fromArray(array $data): self
    {
        foreach (['name','date'] as $key) {
            if (!array_key_exists($key, $data)) {
                throw new DtoMappingException("ParcelStatusDto: missing field '{$key}'");
            }
        }

        return new self(
            (string)$data['name'],
            (string)$data['date'],
        );
    }

    /**
     * Возвращает Наименование статуса
     * @return string
     */
    function getName(): string
    {
        return $this->name;
    }

    /**
     * Возвращает дату получения статуса
     * @return string
     */
    function getDate(): string
    {
        return $this->date;
    }
}
