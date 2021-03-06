<?php

namespace BVB\Domain\Ticker;

use Exception;

interface TickerRepository
{
    public function getTickerInfo(string $ticker): TickerInfo;

    /** @throws Exception */
    public function getLastClosed(string $ticker): float;
}
