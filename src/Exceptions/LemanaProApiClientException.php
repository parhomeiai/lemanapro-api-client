<?php

namespace Escorp\LemanaProApiClient\Exceptions;

use RuntimeException;
use Throwable;

class LemanaProApiClientException extends RuntimeException
{
    public static function fromException(Throwable $e): self
    {
        return new self($e->getMessage(), (int) $e->getCode(), $e);
    }
}

