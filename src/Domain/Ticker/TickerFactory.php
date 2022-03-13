<?php

namespace BVB\Domain\Ticker;

use BVB\Infrastructure\Ticker\BVBTicker;

class TickerFactory
{
    private TickerRepository $tickerRepository;

    public function __construct(TickerRepository $tickerRepository)
    {
        $this->tickerRepository = $tickerRepository;
    }

    public function create(string $ticker): Ticker
    {
        return new BVBTicker($ticker, $this->tickerRepository);
    }
}
