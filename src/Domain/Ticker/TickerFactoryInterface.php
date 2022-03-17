<?php

namespace BVB\Domain\Ticker;

interface TickerFactoryInterface
{
    public function createTicker(string $ticker): Ticker;
}
