<?php

namespace BVB\Infrastructure\Ticker;

use ArrayObject;
use Exception;
use BVB\Domain\Ticker\Ticker;
use BVB\Domain\Ticker\TickerInfo;
use BVB\Domain\Ticker\TickerRepository;

class BVBTicker implements Ticker
{
    private TickerRepository $tickerRepository;
    private string $ticker;

    public function __construct(string $ticker, TickerRepository $tickerRepository)
    {
        $this->ticker = $ticker;
        $this->tickerRepository = $tickerRepository;
        if (false === $this->exists()) {
            throw new Exception('Ticker not found on Bucharest Stock Exchange');
        }
    }

    public function getPrice(): float
    {
        return $this->tickerRepository->getLastClosed($this->ticker);
    }

    public function getInfo(): TickerInfo
    {
        return $this->tickerRepository->getTickerInfo($this->ticker);
    }

    private function exists(): bool
    {
        try {
            $this->getInfo();
        } catch (Exception $exception) {
            return false;
        }
        return true;
    }
}
