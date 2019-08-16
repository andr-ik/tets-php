<?php

namespace App\Service;

use App\Collection\HistoryCollection;
use App\Repository\FlatRepository;
use App\Repository\HistoryRepository;

class HistoryService
{
    /**
     * @var FlatRepository
     */
    private $flatRepository;
    /**
     * @var HistoryRepository
     */
    private $historyRepository;

    public function __construct(FlatRepository $flatRepository, HistoryRepository $historyRepository)
    {
        $this->flatRepository = $flatRepository;
        $this->historyRepository = $historyRepository;
    }

    public function load(): HistoryCollection
    {
        $flats = $this->flatRepository->findAll();
        $history = $this->historyRepository->findAllGroupByFlat();

        $historyCollection = new HistoryCollection($flats, $history);

        return $historyCollection;
    }
}
