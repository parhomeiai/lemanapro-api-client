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
     *
     * @param int $page
     * @param int $perPage
     * @return type
     */
    public function locations(int $page = 0, int $perPage = 20)
    {
        $url = $this->baseUrl . '/locations/logistic-location-public/v1/logistic-locations';

        $query = [
            'page' => $page,
            'perPage' => $perPage
        ];

        $response = $this->request('GET', $url, [
            'query'   => $query,
        ]);

        return $response;
//        return PingResponseDto::fromArray($response);
    }
}
