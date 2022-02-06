<?php

namespace BVB\Domain\Ticker;

interface Ticker
{
    public function getPrice(): float;

    public function getInfo(): TickerInfo;
}
