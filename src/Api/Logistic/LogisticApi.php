<?php

namespace Escorp\LemanaProApiClient\Api\Logistic;

use Escorp\LemanaProApiClient\Api\AbstractLemanaProApi;
//use Escorp\WbApiClient\Dto\Common\PingResponseDto;

/**
 * Логистика
 * API для получения информации о логистических локациях
 *
 * @author parhomey
 */
class LogisticApi extends AbstractLemanaProApi
{
    /**
     * Метод возвращает список логистических локаций, соответствующих указанному владельцу
     * @return PingResponseDto
     */
    public function locations()
    {
        $url = $this->baseUrl . '/locations/logistic-location-public/v1/logistic-locations';

        $response = $this->request('GET', $url);

        return $response;
//        return PingResponseDto::fromArray($response);
    }
}
