<?php

use BVB\Domain\Ticker\TickerRepository;
use BVB\Domain\Ticker\TickerValidator;
use BVB\Infrastructure\Ticker\BVBTicker;

beforeEach(function() {
    $this->tickerRepository = Mockery::mock(TickerRepository::class);
    $this->tickerValidator = Mockery::mock(TickerValidator::class);
    $this->tickerRepository->shouldReceive('getLastClosed')->with('ticker')->andReturns(1);
    $this->tickerValidator->shouldReceive('exists')->with('ticker')->andReturns(true);
});

it('should be an instance of BVBTicker', function () {
    $ticker = new BVBTicker('ticker', $this->tickerRepository, $this->tickerValidator);
    $this->assertInstanceOf(BVBTicker::class, $ticker);
})->group('infrastructure');

test('ticker price is not null', function () {
    $ticker = new BVBTicker('ticker', $this->tickerRepository, $this->tickerValidator);
    $this->assertNotNull($ticker->getPrice());
})->group('infrastructure');

test('ticker price is float', function () {
    $ticker = new BVBTicker('ticker', $this->tickerRepository, $this->tickerValidator);
    $this->assertIsFloat($ticker->getPrice());
})->group('infrastructure');
