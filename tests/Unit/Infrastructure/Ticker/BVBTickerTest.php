<?php

use BVB\Infrastructure\Ticker\BVBTicker;
use BVB\Infrastructure\Ticker\TickerHistoryRepository;

it('should be an instance of BVBTicker', function () {
    /** @var TickerHistoryRepository $historyRepository */
    $historyRepository = Mockery::mock(TickerHistoryRepository::class);
    $ticker = new BVBTicker('TRP', $historyRepository);
    $this->assertInstanceOf(BVBTicker::class, $ticker);
})->group('infrastructure');

test('ticker price is not null', function () {
    /** @var TickerHistoryRepository $historyRepository */
    $historyRepository = mock(TickerHistoryRepository::class)->expect(
        getLastClosed: fn () => 1.0
    );
    $ticker = new BVBTicker('TRP', $historyRepository);
    $this->assertNotNull($ticker->getPrice());
})->group('infrastructure');

test('ticker price is float', function () {
    /** @var TickerHistoryRepository $historyRepository */
    $historyRepository = mock(TickerHistoryRepository::class)->expect(
        getLastClosed: fn () => 1.0
    );
    $ticker = new BVBTicker('TRP', $historyRepository);
    $this->assertIsFloat($ticker->getPrice());
})->group('infrastructure');
