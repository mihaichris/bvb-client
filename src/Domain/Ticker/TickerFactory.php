<?php

namespace BVB\Domain\Ticker;

use BVB\Infrastructure\Ticker\BVBTicker;
use BVB\Infrastructure\Ticker\TickerHistoryRepository;

class TickerFactory
{
    private TickerHistoryRepository $historyRepository;

    public function __construct(TickerHistoryRepository $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    public function create(string $ticker): Ticker
    {
        return new BVBTicker($ticker, $this->historyRepository);
    }
}
