<?php

namespace BVB\Infrastructure\Ticker;

use BVB\Domain\Ticker\Ticker;
use BVB\Domain\Ticker\TickerInfo;
use BVB\Infrastructure\Ticker\TickerHistoryRepository;

class BVBTicker implements Ticker
{
    private TickerHistoryRepository $historyRepository;
    private string $ticker;

    public function __construct(string $ticker, TickerHistoryRepository $historyRepository)
    {
        $this->ticker = $ticker;
        $this->historyRepository = $historyRepository;
    }

    public function getPrice(): float
    {
        return $this->historyRepository->getLastClosed($this->ticker);
    }

    public function getInfo(): TickerInfo
    {
        return new TickerInfo();
    }
}
