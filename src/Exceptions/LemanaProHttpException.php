<?php


namespace Escorp\LemanaProApiClient\Exceptions;

use Escorp\LemanaProApiClient\Dto\LemanaProErrorDto;

/**
 * Расширенный Exception для ошибок Http
 *
 */
class LemanaProHttpException extends LemanaProApiClientException
{
    private $httpStatus;

    /**
     * DTO ошибки LemanaPro
     * @var WbErrorDto
     */
    private LemanaProErrorDto $error;

    /**
     *
     * @param WbErrorDto $error
     */
    public function __construct(LemanaProErrorDto $error, $httpStatus = null)
    {
        $code = ($error->code) ? ($error->code) : ($error->statusCode);
        $message = (is_array($error->message)) ? (reset($error->message)) : ($error->message);
        $message = ($message) ? ($message) : ($error->error);

        parent::__construct($message, $code);
        $this->error = $error;
        $this->httpStatus = $httpStatus;
    }

    /**
     * Возвращает DTO ошибки LemanaPro
     * @return LemanaProErrorDto
     */
    public function getError(): LemanaProErrorDto
    {
        return $this->error;
    }

    public function getStatus()
    {
        return $this->getStatus();
    }
}
