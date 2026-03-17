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
