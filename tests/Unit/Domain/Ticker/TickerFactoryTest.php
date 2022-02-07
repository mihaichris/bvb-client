<?php

use BVB\Domain\Ticker\TickerFactory;
use BVB\Infrastructure\Ticker\BVBTicker;
use BVB\Infrastructure\Ticker\TickerHistoryRepository;

beforeEach(function () {
    $this->historyRepository = Mockery::mock(TickerHistoryRepository::class);
    $this->factory = new TickerFactory($this->historyRepository);
});

it("should create a ticker class", function (string $ticker) {
    $ticker = $this->factory->create($ticker);
    $this->assertInstanceOf(BVBTicker::class, $ticker);
})->with(['TRP', 'IMP', 'ALR']);
