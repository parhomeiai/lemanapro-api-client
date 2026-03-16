<?php

namespace Escorp\LemanaProApiClient\Api\Stocks;

use Escorp\LemanaProApiClient\Api\AbstractLemanaProApi;

use Escorp\LemanaProApiClient\Dto\Stocks\StockDto;
use Escorp\LemanaProApiClient\Dto\Stocks\StocksSearchResponse;
use Escorp\LemanaProApiClient\Dto\Stocks\UpdateStocksResponse;

use InvalidArgumentException;

/**
 * Остатки
 * API для работы с остатками товаров на складах мерчанта
 */
class StocksApi extends AbstractLemanaProApi
{
    /**
     * Возвращает информацию о текущих остатках товаров по запрошенным артикулам (код ЛМ) мерчанта на конкретном складе
     *
     * @param array $productBUReferences - Список артикулов (код ЛМ) товаров
     * @param string $logisticLocationId
     * @return StockDto[]
     */
    public function getStocks(array $productBUReferences, string $logisticLocationId): array
    {
        $url = $this->baseUrl . '/stocks/stock-repository-merchants/v1/merchant-stocks:search';

        $result = [];
        foreach(array_chunk($productBUReferences, 500) as $productBUReferencesChunck){
            $response = $this->request('POST', $url, [
                'json'   => [
                    'logisticLocationId' => $logisticLocationId,
                    'productBUReferences' => $productBUReferencesChunck,
                ],
            ]);

            $stocksSearchResponse = StocksSearchResponse::fromArray($response);

            foreach ($stocksSearchResponse->stocks() as $stockDto) {
                $result[] = $stockDto;
            }
        }

        return $result;
    }

    /**
     * Метод для загрузки информации об остаках по товарам в разрезе одного склада
     *
     * @param StockDto[] $stocks
     * @param string $logisticLocationId
     * @return UpdateStocksResponse
     * @throws InvalidArgumentException
     */
    public function updateStocks(array $stocks, string $logisticLocationId): UpdateStocksResponse
    {
        if(count($stocks) > 500){
            throw new InvalidArgumentException('stocks must be an array of no more than 1000 elements');
        }

        foreach ($stocks as $s) {
            if (!$s instanceof StockDto) {
                throw new InvalidArgumentException('stocks must contain StockDto');
            }
        }

        $url = $this->baseUrl . '/stocks/stock-repository-merchants/v1/merchant-stocks:update';

        $response = $this->request('POST', $url, [
                'json'   => [
                    'logisticLocationId' => $logisticLocationId,
                    'productBUReferences' => array_map(function(StockDto $stock){return $stock->toArray();}, $stocks),
                ],
            ]);

        return UpdateStocksResponse::fromArray($response);
    }

    /**
     * Метод для загрузки информации об остаках по товарам в разрезе одного склада
     *
     * @param StockDto[] $stocks
     * @param string $logisticLocationId
     * @return StockErrorDto[]
     */
    public function updateStocksBatch(array $stocks, string $logisticLocationId): array
    {
        $errors = [];

        foreach(array_chunk($stocks, 500) as $stocksChunck){
            $response = $this->updateStocks($stocksChunck, $logisticLocationId);

            foreach($response->errors() as $stockErrorDto){
                $errors[] = $stockErrorDto;
            }
        }

        return $errors;
    }
}
