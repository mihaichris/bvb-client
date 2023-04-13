<?php

namespace BVB\Infrastructure\Ticker;

use BVB\Domain\Ticker\TickerValidator;
use Exception;
use BVB\Domain\Ticker\Ticker;
use BVB\Domain\Ticker\TickerRepository;

class BVBTicker implements Ticker
{
    private TickerRepository $tickerRepository;
    private string $ticker;

    /**
     * @throws Exception
     */
    public function __construct(string $ticker, TickerRepository $tickerRepository, TickerValidator $tickerValidator)
    {
        $this->ticker = $ticker;
        $this->tickerRepository = $tickerRepository;
        if (false === $tickerValidator->exists($ticker)) {
            throw new Exception('Ticker not found on Bucharest Stock Exchange');
        }
    }

    /**
     * @throws Exception
     */
    public function getPrice(): float
    {
        return $this->tickerRepository->getLastClosed($this->ticker);
    }
}
