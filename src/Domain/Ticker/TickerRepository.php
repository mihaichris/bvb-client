<?php

namespace BVB\Domain\Ticker;

use Exception;

interface TickerRepository
{
    /** @throws Exception */
    public function getLastClosed(string $ticker): float;
}
