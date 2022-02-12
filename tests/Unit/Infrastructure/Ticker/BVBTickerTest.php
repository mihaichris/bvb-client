<?php

use BVB\Domain\Ticker\TickerInfo;
use Pest\Mock\Mock;
use BVB\Domain\Ticker\TickerRepository;
use BVB\Infrastructure\Ticker\BVBTicker;

beforeEach(function () {
    $this->tickerRepository = mock(TickerRepository::class);
});

it('should be an instance of BVBTicker', function () {
    /** @var Mock $tickerRepository */
    $tickerRepository = $this->tickerRepository;
    /** @var Mock $tickerInfo */
    $tickerInfo = mock(TickerInfo::class);
    $tickerRepository = $tickerRepository->expect(
        getTickerInfo: fn () => $tickerInfo->expect()
    );
    /** @var TickerRepository $tickerRepository */
    $ticker = new BVBTicker('TRP', $tickerRepository);
    $this->assertInstanceOf(BVBTicker::class, $ticker);
})->group('infrastructure');

test('ticker price is not null', function () {
    /** @var Mock $tickerRepository */
    $tickerRepository = $this->tickerRepository;
    /** @var Mock $tickerInfo */
    $tickerInfo = mock(TickerInfo::class);
    $tickerRepository = $tickerRepository->expect(
        getLastClosed: fn () => 1.0,
        getTickerInfo: fn () => $tickerInfo->expect()
    );
    /** @var TickerRepository $tickerRepository */
    $ticker = new BVBTicker('TRP', $tickerRepository);
    $this->assertNotNull($ticker->getPrice());
})->group('infrastructure');

test('ticker price is float', function () {
    /** @var Mock $tickerRepository */
    $tickerRepository = $this->tickerRepository;
    /** @var Mock $tickerInfo */
    $tickerInfo = mock(TickerInfo::class);
    $tickerRepository = $tickerRepository->expect(
        getLastClosed: fn () => 1.0,
        getTickerInfo: fn () => $tickerInfo->expect()
    );
    /** @var TickerRepository $tickerRepository */
    $ticker = new BVBTicker('TRP', $tickerRepository);
    $this->assertIsFloat($ticker->getPrice());
})->group('infrastructure');
