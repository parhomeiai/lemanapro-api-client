<?php

namespace Escorp\LemanaProApiClient\Contracts;

interface TokenProviderInterface
{
    public function getToken(): string;
}