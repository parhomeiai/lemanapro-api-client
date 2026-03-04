<?php

namespace Escorp\LemanaProApiClient\Dto;

/**
 * Данные об ошибке
 *
 */
class LemanaProErrorDto
{

    /**
     * Данные
     * @var mixed
     */
    public $data;


    /**
     * Код ошибки
     * @var int|null
     */
    public ?int $code;

    /**
     * Детали ошибки
     * @var string|null
     */
    public ?string $message;

    /**
     *
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        $dto = new self();

        $dto->data = $data;

        $dto->code       = isset($data['code']) ? (int)$data['code'] : null;
        $dto->message  = isset($data['message']) ? (string)$data['message'] : null;

        return $dto;
    }
}
