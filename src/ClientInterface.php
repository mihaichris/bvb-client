<?php

namespace BVB;

use BVB\Domain\Ticker\Ticker;

interface ClientInterface
{
    public function getTicker(string $ticker): Ticker;

    public function getTickerPrice(string $ticker): float;
}
