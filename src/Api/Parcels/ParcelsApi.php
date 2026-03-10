<?php

namespace Escorp\LemanaProApiClient\Api\Parcels;

use Escorp\LemanaProApiClient\Api\AbstractLemanaProApi;
use Escorp\LemanaProApiClient\Dto\LemanaProApiResponseDto;
use Escorp\LemanaProApiClient\Dto\Parcels\ParcelsResponse;
use Escorp\LemanaProApiClient\Dto\Parcels\ParcelStatusDto;
use Escorp\LemanaProApiClient\Dto\Parcels\ParcelCancelDto;
use Escorp\LemanaProApiClient\Dto\Parcels\ParcelDto;
use Escorp\LemanaProApiClient\Dto\Parcels\ParcelBoxesDto;

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

    /**
     * Подтвердить отправления
     * Переводит массив отправлений по переданным идентификаторам в теле запроса в формате MP0123456-001 в статус "Подтверждено".
     *
     * @param array $parcelsIds - идентификаторы отправления в формате MP0123456-001.
     * @return array - ["MP01234567-001" => "Success"]
     */
    public function parcelsConfirm(array $parcelsIds): array
    {
        $url = $this->baseUrl . '/orders/merchants/v1/parcels:confirm';

        $response = $this->request('POST', $url, [
            'json'   => $parcelsIds,
        ]);

        return $response;
    }

    /**
     * Отменить отправления
     *
     * @param array $parcelsCancels
     * @return array - ["MP01234567-001": "Ok",]
     * @throws InvalidArgumentException
     */
    public function parcelsCancel(array $parcelsCancels): array
    {
        foreach ($parcelsCancels as $p) {
            if (!$p instanceof ParcelCancelDto) {
                throw new InvalidArgumentException('parcelsCancels must contain ParcelCancelDto');
            }
        }

        $url = $this->baseUrl . '/orders/merchants/v1/parcels:cancel';

        $response = $this->request('POST', $url, [
            'json'   => [
                array_map(function(ParcelCancelDto $parcelCancelDto){return $parcelCancelDto->toArray();}, $parcelsCancels)
            ],
        ]);

        return $response;
    }

    /**
     * Скомплектовать отправления
     * Переводит массив отправлений по переданным идентификаторам в теле запроса в формате MP0123456-001 в статус "Скомплектовано".
     *
     * @param array $parcelsIds
     * @return array - ["MP01234567-001": "Ok"]
     */
    public function parcelsPack(array $parcelsIds): array
    {
        $url = $this->baseUrl . '/orders/merchants/v1/parcels:pack';

        $response = $this->request('POST', $url, [
            'json'   => $parcelsIds,
        ]);

        return $response;
    }

    /**
     * Получить отправление по parcelId
     * Возвращает информацию об отправлении по переданному идентификатору в формате MP0123456-001.
     *
     * @param string $parcelId
     * @return ParcelDto
     */
    public function getParcelById(string $parcelId): ParcelDto
    {
        $url = $this->baseUrl . '/orders/merchants/v1/parcels/' . $parcelId;

        $response = $this->request('GET', $url);

        return ParcelDto::fromArray($response);
    }

    /**
     * Подтвердить отправление
     *
     * @param string $parcelId
     * @return LemanaProApiResponseDto
     */
    public function parcelConfirm(string $parcelId): LemanaProApiResponseDto
    {
        $url = $this->baseUrl . '/orders/merchants/v1/parcels/' . $parcelId . ':confirm';

        $response = $this->request('POST', $url);

        return new LemanaProApiResponseDto($response);
    }

    /**
     * Отменить отправление
     * @param ParcelCancelDto $prcelCancelDto
     * @return LemanaProApiResponseDto
     */
    public function parcelCancel(ParcelCancelDto $prcelCancelDto): LemanaProApiResponseDto
    {
        $url = $this->baseUrl . '/orders/merchants/v1/parcels/' . $prcelCancelDto->parcelId . ':cancel';

        $response = $this->request('POST', $url, [
            'query'   => [
                'stage' => $prcelCancelDto->stage,
                'reason' => $prcelCancelDto->reason,
            ]
        ]);

        return new LemanaProApiResponseDto($response);
    }

    /**
     * Скомплектовать отправление
     * @param string $parcelId
     * @return LemanaProApiResponseDto
     */
    public function parcelPack(string $parcelId): LemanaProApiResponseDto
    {
        $url = $this->baseUrl . '/orders/merchants/v1/parcels/' . $parcelId . ':pack';

        $response = $this->request('POST', $url);

        return new LemanaProApiResponseDto($response);
    }


    /**
     * Получить статусы отправления
     * @param string $parcelId
     * @return ParcelStatusDto[]
     * @throws InvalidArgumentException
     */
    public function getParcelStatuses(string $parcelId): array
    {
        $url = $this->baseUrl . '/orders/merchants/v1/parcels/' . $parcelId . '/statuses';

        $response = $this->request('GET', $url);

        $result = [];

        foreach($response as $key => $item){
            if (!is_array($item)) {
                throw new InvalidArgumentException('ParcelStatusDto must contain array');
            }

            $result[] = ParcelStatusDto::fromArray($item);
        }

        return $result;
    }

    /**
     * Получить грузоместа отправления
     * 
     * @param string $parcelId
     * @return array
     */
    public function getParcelBoxes(string $parcelId): array
    {
        $url = $this->baseUrl . '/orders/merchants/v1/parcels/' . $parcelId . '/boxes';

        $response = $this->request('GET', $url);

        $result = [];

        foreach($response as $item){
            $result[] = ParcelBoxesDto::fromArray($item);
        }

        return $result;
    }
}
