<?php

namespace BVB;

use BVB\Domain\Ticker\Ticker;
use BVB\Domain\Ticker\TickerInfo;

interface ClientInterface
{
    public function getTicker(string $ticker): Ticker;

    public function getTickerPrice(string $ticker): float;

    public function getTickerInfo(string $ticker): TickerInfo;
}
