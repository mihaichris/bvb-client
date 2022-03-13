<?php

use BVB\Domain\Ticker\Ticker;
use BVB\Domain\Ticker\TickerFactory;
use BVB\Domain\Ticker\TickerInfo;
use BVB\Domain\Ticker\TickerRepository;

beforeEach(function () {
    /** @var Mock $tickerRepository */
    $tickerRepository = mock(TickerRepository::class);
    $this->tickerInfo = mock(TickerInfo::class);
    $tickerRepository = $tickerRepository->expect(
        getTickerInfo: fn () => $this->tickerInfo->expect()
    );
    /** @var TickerRepository $tickerRepository */
    $this->factory = new TickerFactory($tickerRepository);
});

it("should create a ticker class", function (string $ticker) {
    /** @var TickerFactory $factory */
    $factory = $this->factory;
    $ticker = $factory->create($ticker);
    expect($ticker)->toBeInstanceOf(Ticker::class);
})->with(['TRP', 'IMP', 'ALR']);
