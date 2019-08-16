<?php

namespace App\Controller;

use App\Collection\HistoryCollection;
use App\Service\HistoryService;
use DateInterval;
use DatePeriod;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param HistoryService $historyService
     * @return Response
     * @throws \Exception
     */
    public function index(HistoryService $historyService)
    {
        $dateStart = new \DateTime("2019-07-11");
        $dateEnd = new \DateTime("now");
        $dateInterval = new \DateInterval("P1D");
        $dateInterval = new \DatePeriod($dateStart, $dateInterval, $dateEnd);

        return $this->render('index/index.html.twig', [
            'historyCollection' => $historyService->load(),
            'dateInterval' => $dateInterval,
        ]);
    }


    /**
     * @Route("/api/price", name="api_price")
     * @param HistoryService $historyService
     * @return Response
     * @throws \Exception
     */
    public function apiPrice(HistoryService $historyService)
    {
        return $this->apiResponse($this->preparePrice($historyService->load(), $this->getDateInterval()));
    }

    /**
     * @Route("/api/header", name="api_header")
     * @return Response
     */
    public function apiHeader()
    {
        return $this->apiResponse($this->prepareHeader($this->getDateInterval()));
    }

    private function preparePrice(HistoryCollection $historyService, \DatePeriod $dateInterval): array
    {
        $data = [];
        foreach ($historyService->getFlats() as $flat) {
            $row = [
                'id' => $flat->getId(),
            ];

            /** @var \DateTime $date */
            foreach ($dateInterval as $date) {
                $row[$date->format('d-m')] = $historyService->getPrice($flat, $date);
            }

            $data[] = $row;
        }

        return $data;
    }


    private function prepareHeader(DatePeriod $dates)
    {
        $headers = ['id'];
        /** @var DateTime $date */
        foreach ($dates as $date) {
            $headers[] = $date->format('d-m');
        }

        return $headers;
    }

    private function getDateInterval(): DatePeriod
    {
        $dateStart = new DateTime("2019-07-11");
        $dateEnd = new DateTime("now");
        $dateInterval = new DateInterval("P1D");

        return new DatePeriod($dateStart, $dateInterval, $dateEnd);
    }

    private function apiResponse(array $data): JsonResponse
    {
        return new JsonResponse($data, 200, ['Access-Control-Allow-Origin' => '*']);
    }
}
