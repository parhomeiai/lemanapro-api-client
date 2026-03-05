<?php

namespace Escorp\LemanaProApiClient\Api\Logistic;

use Escorp\LemanaProApiClient\Api\AbstractLemanaProApi;
use Escorp\LemanaProApiClient\Dto\Logistic\LocationsResponse;

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
     * @return LocationsResponse
     */
    public function getLocations(int $page = 0, int $perPage = 20): LocationsResponse
    {
        $url = $this->baseUrl . '/locations/logistic-location-public/v1/logistic-locations';

        $query = [
            'page' => $page,
            'perPage' => $perPage
        ];

        $response = $this->request('GET', $url, [
            'query'   => $query,
        ]);

        return LocationsResponse::fromArray($response);
    }

    /**
     * Возвращает весь список логистических локаций, соответствующих указанному владельцу
     * @return array
     */
    public function getLocationsBatch(): array
    {
        $page = 0;
        $perPage = 20;

        $result = [];

        do{
            $response = $this->getLocations($page, $perPage);

            if(empty($response->logisticLocations)){
                break;
            }

            foreach ($response->logisticLocations as $logisticLocations) {
                $result[] = $logisticLocations;
            }

            $page++;
            usleep(600_000);
        }while(true);

        return $result;
    }
}
