<?php

namespace BVB\Infrastructure\Ticker;

use BVB\Domain\Ticker\Ticker;
use BVB\Domain\Ticker\TickerFactoryInterface;
use BVB\Domain\Ticker\TickerRepository;
use BVB\Infrastructure\Ticker\BVBTicker;

class TickerFactory implements TickerFactoryInterface
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
