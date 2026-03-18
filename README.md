# Lemanapro API Client

*Lemanapro Laravel Package* - PHP SDK Laravel пакет для взаимодействия с API [lemanapro.ru](https://lemanapro.ru/)

## Требования
- Версии PHP: 7.3+
- Версии Laravel: 5.3+

## Использование PHP
```php
 $clientId = "Replace with lemanapro client id";
 $clientSecret = "Replace with lemanapro secret key";
 $lemanaProApiClient = LemanaProApiClientFactory::make($clientId, $clientSecret);
```

Затем вызовайте методы API, как указано ниже.

## Логистика
### [Получение информации о логистических локациях конкретного владельца](https://developers.lemanapro.ru/api_partners/#tag/Logistika/operation/findOwnerLogisticLocation)
`$lemanaProApiClient->logisticApi()->getLocations(int $page = 0, int $perPage = 20)` - Метод возвращает список логистических локаций, соответствующих указанному владельцу в постраничном виде. Возвращает объект `LocationsResponse`.

```php
 $locationsResponse = $lemanaProApiClient->logisticApi()->getLocations();
 $logisticLocations = $locationsResponse->logisticLocations();
 foreach($logisticLocations as $logisticLocationDto){
   echo "ID: {$logisticLocationDto->logisticLocationId}; Тип: {$logisticLocationDto->logisticLocationType}; Название: {$logisticLocationDto->name}; Статус: {$logisticLocationDto->status}";
 }
```

`$lemanaProApiClient->logisticApi()->getLocationsBatch()` - Метод возвращает весь список логистических локаций, соответствующих указанному владельцу. Возвращает массив объектов `LogisticLocationsDto`.

## Отправления
### [Получить статусы для отправлений](https://developers.lemanapro.ru/api_partners/#tag/Otpravleniya/operation/ParcelsBatchesController_parcelsStatusesFindBatch)
`$lemanaProApiClient->parcelsApi()->getParcelsStatuses(array $parcelsIds)` - Метод возвращает список отправлений с историческими статусами. В теле запроса необходимо передать идентификаторы отправления в формате MP0123456-001. Возвращает массив объектов `ParcelStatusDto`.

### [Подтвердить отправления](https://developers.lemanapro.ru/api_partners/#tag/Otpravleniya/operation/ParcelsBatchesController_parcelStatusConfirm)
`$lemanaProApiClient->parcelsApi()->parcelsConfirm(array $parcelsIds)` - Метод переводит массив отправлений по переданным идентификаторам в теле запроса в формате MP0123456-001 в статус "Подтверждено".

### [Отменить отправления](https://developers.lemanapro.ru/api_partners/#tag/Otpravleniya/operation/ParcelsBatchesController_parcelStatusCancel)
`$lemanaProApiClient->parcelsApi()->parcelsCancel(array $parcelsCancels)` - Переводит массив отправлений по переданным идентификаторам в теле запроса в формате MP0123456-001 в статус "Отменено". `$parcelsCancels` - массив объектов `ParcelCancelDto`. Возвращает массив вида `["MP01234567-001" => "Ok"]`.

### [Скомплектовать отправления](https://developers.lemanapro.ru/api_partners/#tag/Otpravleniya/operation/ParcelsBatchesController_parcelsStatusPack)
`$lemanaProApiClient->parcelsApi()->parcelsPack(array $parcelsIds)` - Переводит массив отправлений по переданным идентификаторам в теле запроса в формате MP0123456-001 в статус "Скомплектовано". Возвращает массив вида `["MP01234567-001" => "Ok"]`.

### [Получить список отправлений](https://developers.lemanapro.ru/api_partners/#tag/Otpravleniya/operation/ParcelsController_parcelsFind)
`$lemanaProApiClient->parcelsApi()->getParcels(?string $status = null, int $limit = 100, int $offset = 0)` - Возвращает список отправлений с возможностью пагинации с помощью Query-параметров: limit и offset. Сортировка результатов производится от новых к старым.Результаты возвращаются постранично. Возможные значени параметра `$status`: `"created" "canceled" "packingStarted" "awaitingMarking" "failedMarking" "expiredMarking" "successMarking" "refused" "packingCompleted" "shipped" "deliveryStarted" "delivered"`. Возвращает объект `ParcelsResponse`.

`$lemanaProApiClient->parcelsApi()->getParcelsBatch(?string $status = null)` - Возвращает список всех отправлений в указанном статусе. Возвращает массив объектов `ParcelDto`.

### [Получить отправление по parcelId](https://developers.lemanapro.ru/api_partners/#tag/Otpravleniya/operation/ParcelsController_parcelRead)
`$lemanaProApiClient->parcelsApi()->getParcelById(string $parcelId)` - Возвращает информацию об отправлении по переданному идентификатору в формате MP0123456-001. Возвращает объект `ParcelDto`.

### [Подтвердить отправление](https://developers.lemanapro.ru/api_partners/#tag/Otpravleniya/operation/ParcelsController_parcelConfirm)
`$lemanaProApiClient->parcelsApi()->parcelConfirm(string $parcelId)` - Подтверждает возможность отправить отправление. Переводит отправление по переданному идентификатору в формате MP0123456-001 в статус "Подтверждено".

### [Отменить отправление](https://developers.lemanapro.ru/api_partners/#tag/Otpravleniya/operation/ParcelsController_parcelCancel)
`$lemanaProApiClient->parcelsApi()->parcelCancel(ParcelCancelDto $prcelCancelDto)` - Переводит отправление по переданному идентификатору в формате MP0123456-001 в статус "Отменено". Данный метод можно использовать до статуса "Подтвержено" или после статуса "Подтверждено". В остальных случаях он будет отдавать 409 ответ (конфликт запроса).

### [Скомплектовать отправление]()
`$lemanaProApiClient->parcelsApi()->parcelPack(string $parcelId)` - Переводит отправление по переданному идентификатору в формате MP0123456-001 в статус "Скомплектовано".

## Цены
### [Загрузить продажные цен](https://developers.lemanapro.ru/api_partners/#tag/Ceny)
`$lemanaProApiClient->pricesApi()->uploadSellerSalesPrices(array $salesPrices)` - Метод для загрузки продажных цен. `$salesPrices` - массив объектов `SalesPriceDto`. Возвращает объект `UploadSellerSalesPricesResponse`.

## Товары
### [Поиск товаров по заданным параметрам.](https://developers.lemanapro.ru/api_partners/#tag/Tovary/operation/findItemById)
`$lemanaProApiClient->productsApi()->getSellerCommercialItems(array $commercialItemBuReference = [], int $page = 0, int $perPage = 50, bool $withTotalCount = false)` - Метод возвращает список всех товаров с основной информацией по ним в постраничном виде. Возвращает объект `SellerCommercialItemsResponse`.

`$lemanaProApiClient->productsApi()->getSellerCommercialItemsBatch(array $commercialItemBuReference = [])` - Метод возвращает список всех товаров с основной информацией по ним. Возвращает массив объектов `SellerCommercialItemDto`.

## Остатки
### [Получение информации об остатках на складах мерчанта](https://developers.lemanapro.ru/api_partners/#tag/Ostatki/paths/~1stocks~1stock-repository-merchants~1v1~1merchant-stocks:search/post)
`$lemanaProApiClient->stocksApi()->getStocks(array $productBUReferences, string $logisticLocationId)` - Метод для получения информации о текущих остатках товаров по запрошенным артикулам (код ЛМ) мерчанта на конкретном складе. Возвращает массив объектов `StockDto`.

### [Загрузка информации о стоках мерчанта](https://developers.lemanapro.ru/api_partners/#tag/Ostatki/paths/~1stocks~1stock-repository-merchants~1v1~1merchant-stocks:update/post)
`$lemanaProApiClient->stocksApi()->updateStocksBatch(array $stocks, string $logisticLocationId)` - Метод для загрузки информации об остаках по товарам в разрезе одного склада. Возвращает массив объектов ошибок `StockErrorDto` или пустой массив.
