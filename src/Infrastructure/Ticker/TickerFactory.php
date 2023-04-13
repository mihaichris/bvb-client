<?php

namespace BVB\Infrastructure\Ticker;

use BVB\Domain\Ticker\Ticker;
use BVB\Domain\Ticker\TickerFactoryInterface;
use BVB\Domain\Ticker\TickerRepository;
use BVB\Domain\Ticker\TickerValidator;

class TickerFactory implements TickerFactoryInterface
{
    public function __construct(private TickerRepository $tickerRepository, private TickerValidator $tickerValidator)
    {
    }

    public function create(string $ticker): Ticker
    {
        return new BVBTicker($ticker, $this->tickerRepository, $this->tickerValidator);
    }
}
