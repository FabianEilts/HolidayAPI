<?php

namespace App\Controller;

use App\Services\DateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class RouteController extends AbstractController
{
    #[Route('/date/{date}', name: 'app_date', methods: 'GET')]
    public function date($date, DateService $dateService): JsonResponse
    {
        $dateService->setRawDate($date);

        $response = $dateService->getResponse();
        $status = $response['status'];
        if(isset($response['errorMessage'])){
            return $this->json(
                [
                    'message' => $response['errorMessage']
                ],
                $status
            );
        }
        $date = $response['date'];
        $holiday = $response['holiday'];

        return $this->json(
            [
                'date' => $date,
                'holiday' => $holiday
            ],
            $status
        );
    }

    #[Route('/day', name: 'app_day', methods: 'GET')]
    public function day(Request $request): JsonResponse
    {
        $date = $request->query->get('date');
        $test = 2 + 4;
        return $this->json([
            'testBerechnung' => $test,
            'date' => $date
        ]);
    }
}
