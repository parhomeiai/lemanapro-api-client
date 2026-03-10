<?php

namespace Escorp\LemanaProApiClient\Dto\Parcels;

use Escorp\LemanaProApiClient\Dto\LemanaProApiResponseDto;

/**
 * Ответ на запрос Создание акта приема - передачи
 *
 * Используется в endpoint:
 * POST https://api.lemanapro.ru:443/orders/merchants/v1/acceptance-reports
 */
class CreateAcceptanceReportsResponse extends LemanaProApiResponseDto
{
    public array $acceptanceReports = [];

    public array $errorParcelIds = [];

    public static function fromArray(array $response): self
    {
        $lemanaProApiResponseDto = parent::fromArray($response);

        $dto = new self($lemanaProApiResponseDto->data);

        if(isset($response['acceptanceReports'])){
            foreach ($response['acceptanceReports'] as $item) {
                $dto->acceptanceReports[] = AcceptanceReportDto::fromArray($item);
            }
        }

        if(isset($response['errorParcelIds'])){
            foreach ($response['errorParcelIds'] as $item) {
                $dto->errorParcelIds[] = ErrorParcelIdDto::fromArray($item);
            }
        }

        return $dto;
    }

    /**
     * Акты приема-передачи
     * @return AcceptanceReportDto[]
     */
    public function acceptanceReports(): array
    {
        return $this->acceptanceReports;
    }

    /**
     * Отправления с ошибками
     * @return ErrorParcelIdDto[]
     */
    public function errorParcelIds(): array
    {
        return $this->errorParcelIds;
    }
}
