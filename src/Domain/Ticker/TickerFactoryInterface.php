<?php

namespace BVB\Domain\Ticker;

interface TickerFactoryInterface
{
    public function create(string $ticker): Ticker;
}
