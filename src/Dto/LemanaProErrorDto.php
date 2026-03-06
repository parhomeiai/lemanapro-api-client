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
     * Код http ответа
     * @var int|null
     */
    public ?int $statusCode;

    /**
     * Детали ошибки. Массив или строка
     * @var mixed|null
     */
    public $message;

    /**
     * Тест ошибки
     * @var string|null
     */
    public ?string $error;

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
        $dto->statusCode       = isset($data['statusCode']) ? (int)$data['statusCode'] : null;
        $dto->error       = isset($data['error']) ? (string)$data['error'] : null;
        $dto->message  = $data['message'] ?? null;

        return $dto;
    }
}
