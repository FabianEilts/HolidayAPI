<?php

declare(strict_types=1);

namespace App\Services;

use DateTime;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\HttpFoundation\JsonResponse;

class DateService
{
    private string $rawDate;
    private string $date;

    public function getResponse(): array
    {
        if(strlen($this->rawDate) != 8){
            return $this->sendErrorResponse(
                400,
                'Invalid date format'
            );
        }
        $this->date = $this->setFormattedDate($this->rawDate);
        return [
            'status' => 200,
            'date' => $this->date,
            'holiday' => 'Ostern'
        ];
    }

    private function sendErrorResponse(int $status, string $message): array
    {
        return [
            'status' => $status,
            'errorMessage' => $message
        ];
    }

    private function setFormattedDate(string $rawDate): string
    {
        $year = $rawDate[0] . $rawDate[1] . $rawDate[2] . $rawDate [3];
        $month = $rawDate[4] . $rawDate[5];
        $day = $rawDate[6] . $rawDate[7];
        return $year . '-' . $month . '-' . $day;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setRawDate(string $rawDate): void
    {
        $this->rawDate = $rawDate;
    }
}