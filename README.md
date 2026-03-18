# Lemanapro API Client

*Lemanapro Laravel Package* - PHP SDK Laravel пакет для взаимодействия с API [lemanapro.ru](https://lemanapro.ru/)

## Требования
- Версии PHP: 7.3+
- Версии Laravel: 5.3+

## Использование PHP
```php
> $clientId = "Replace with lemanapro client id";
> $clientSecret = "Replace with lemanapro secret key";
> $lemanaProApiClient = LemanaProApiClientFactory::make($clientId, $clientSecret);
```

Затем вызовайте методы API, как указано ниже.

## Логистика
### [Получение информации о логистических локациях конкретного владельца](https://developers.lemanapro.ru/api_partners/#tag/Logistika/operation/findOwnerLogisticLocation)
`$lemanaProApiClient->logisticApi()->getLocations(int $page = 0, int $perPage = 20)` - Метод возвращает список логистических локаций, соответствующих указанному владельцу в постраничном виде. Возвращает объект `LocationsResponse`.

```php
> $locationsResponse = $lemanaProApiClient->logisticApi()->getLocations();
> $logisticLocations = $locationsResponse->logisticLocations();
> foreach($logisticLocations as $logisticLocationDto){
>   echo "ID: {$logisticLocationDto->logisticLocationId}; Тип: {$logisticLocationDto->logisticLocationType}; Название: {$logisticLocationDto->name}; Статус: {$logisticLocationDto->status}";
> }
```

`$lemanaProApiClient->logisticApi()->getLocationsBatch()` - Метод возвращает весь список логистических локаций, соответствующих указанному владельцу. Возвращает массив объектов `LogisticLocationsDto`.

## Отправления
### [Получить статусы для отправлений](https://developers.lemanapro.ru/api_partners/#tag/Otpravleniya/operation/ParcelsBatchesController_parcelsStatusesFindBatch)
