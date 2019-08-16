<?php

namespace App\Collection;

use App\Entity\Flat;
use App\Entity\History;
use App\Service\HistoryService;
use DateTime;
use DateTimeInterface;

class HistoryCollection
{
    /**
     * @var Flat[]
     */
    private $flats;
    /**
     * @var array
     */
    private $histories;

    public function __construct(array $flats, array $histories)
    {
        $this->flats = $flats;
        $this->histories = $histories;
    }

    /**
     * @return Flat[]
     */
    public function getFlats(): array
    {
        return $this->flats;
    }

    /**
     * @param Flat $flat
     * @param DateTimeInterface $date
     * @return float
     */
    public function getPrice(Flat $flat, DateTimeInterface $date): float
    {
        if (isset($this->histories[$flat->getId()][$date->format('Y-m-d')])) {
            /** @var History $history */
            $history = $this->histories[$flat->getId()][$date->format('Y-m-d')];

            return $history->getPrice();
        }

        return 0;
    }

    public function getComparePrice(Flat $flat, DateTime $date): float
    {
        $currentPrice = $this->getPrice($flat, $date);
        $tomorrowPrice = $this->getPrice($flat, $date->sub(new \DateInterval("P1D")));

        return $currentPrice - $tomorrowPrice;
    }
}
