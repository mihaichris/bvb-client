<?php

namespace BVB\Domain\Ticker;

interface TickerValidator
{
    public function exists(string $ticker): bool;
}