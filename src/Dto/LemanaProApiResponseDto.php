<?php

declare(strict_types=1);

namespace Escorp\LemanaProApiClient\Dto;

/**
 * Ответ LemanaPro
 */
class LemanaProApiResponseDto
{
    /** @var mixed */
    public $data;

    private $messages = null;

    /**
     *
     * @param mixed $data
     * @param bool $error
     * @param string $errorText
     */
    public function __construct($data)
    {
        $this->data = $data;

        if(isset($data['messages'])){
            $this->messages = $data['messages'];
        }
    }

    /**
     *
     * @param array $response
     * @return self
     */
    public static function fromArray(array $response): self
    {
        return new self(
            $response['data'] ?? $response,
        );
    }

    /**
     * Возвращает сырые данные
     * @return mixed
     */
    function getData(): mixed
    {
        return $this->data;
    }

    /**
     *
     * @return mixed
     */
    function getMessages()
    {
        return $this->messages;
    }
}

