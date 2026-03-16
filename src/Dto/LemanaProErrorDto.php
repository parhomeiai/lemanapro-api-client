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
     * @var mixed
     */
    public $code;

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
     *
     * @var type
     */
    public $details;

    /**
     * Текст ошибки
     * @var mixed
     */
    public $error;

    /**
     *
     * @param array $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        $dto = new self();

        $dto->data = $data;

        $dataError = (isset($data['error']) && is_array($data['error'])) ? ($data['error']) : $data;

        $dto->code       = $dataError['code'] ?? null;
        $dto->statusCode       = isset($dataError['statusCode']) ? (int)$dataError['statusCode'] : null;
        $dto->error       = $data['error'] ?? null;
        $dto->message  = $dataError['message'] ?? null;
        $dto->details  = $dataError['details'] ?? null;

        return $dto;
    }
}
