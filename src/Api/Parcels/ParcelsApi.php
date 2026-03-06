<?php

namespace Escorp\LemanaProApiClient\Api\Parcels;

use Escorp\LemanaProApiClient\Api\AbstractLemanaProApi;
use Escorp\LemanaProApiClient\Dto\Parcels\ParcelsResponse;
use Escorp\LemanaProApiClient\Dto\Parcels\ParcelStatusDto;

use InvalidArgumentException;

/**
 * Отправления
 * API для работы с отправлениями
 *
 */
class ParcelsApi extends AbstractLemanaProApi
{
    /**
     * Возвращает список отправлений с возможностью пагинации с помощью Query-параметров: limit и offset. Сортировка результатов производится от новых к старым.Результаты возвращаются постранично.
     *
     * @param string|null Enum: "created" "canceled" "packingStarted" "awaitingMarking" "failedMarking" "expiredMarking" "successMarking" "refused" "packingCompleted" "shipped" "deliveryStarted" "delivered" $status
     * @param int $limit
     * @param int $offset
     * @return type
     */
    public function getParcels(?string $status = null, int $limit = 100, int $offset = 0)
    {
        $url = $this->baseUrl . '/orders/merchants/v1/parcels';

        $query = [
            'limit' => $limit,
            'offset' => $offset
        ];

        if($status){
            $query['status'] = $status;
        }

        $response = $this->request('GET', $url, [
            'query'   => $query,
        ]);

        return ParcelsResponse::fromArray($response);
    }

    /**
     * Возвращает все отправления
     *
     * @param string|null Enum: "created" "canceled" "packingStarted" "awaitingMarking" "failedMarking" "expiredMarking" "successMarking" "refused" "packingCompleted" "shipped" "deliveryStarted" "delivered" $status
     * @return array
     */
    public function getParcelsBatch(?string $status = null): array
    {
        $limit = 100;
        $offset = 0;

        $result = [];

        do{
            $response = $this->getParcels($status, $limit, $offset);

            if(empty($response->parcels)){
                break;
            }

            foreach ($response->parcels as $parcelDto) {
                $result[] = $parcelDto;
            }

            $offset = $offset + $limit;
            usleep(600_000);
        }while(true);

        return $result;
    }

    /**
     * Получить статусы для отправлений
     * Возвращает список отправлений с историческими статусами
     *
     * @param array $parcelsIds - идентификаторы отправления в формате MP0123456-001.
     * @return array
     * @throws InvalidArgumentException
     */
    public function getParcelsStatuses(array $parcelsIds): array
    {
        $url = $this->baseUrl . '/orders/merchants/v1/parcels:statuses';

        $response = $this->request('POST', $url, [
            'json'   => $parcelsIds,
        ]);

        $result = [];

        foreach($response as $key => $items){
            if (!is_array($items)) {
                throw new InvalidArgumentException('ParcelStatusDto must contain array');
            }
            foreach($items as $item){
                $result[$key][] = ParcelStatusDto::fromArray($item);
            }
        }

        return $result;
    }
}
