<?php

use BVB\Domain\Ticker\Ticker;
use BVB\Domain\Ticker\TickerValidator;
use BVB\Infrastructure\Ticker\TickerFactory;
use BVB\Domain\Ticker\TickerRepository;

beforeEach(function () {
    $tickerRepository = Mockery::mock(TickerRepository::class);
    $tickerValidator = Mockery::mock(TickerValidator::class);
    $tickerRepository->shouldReceive('getLastClosed')->with('ticker')->andReturns(1);
    $tickerValidator->shouldReceive('exists')->with('ticker')->andReturns(true);
    $this->factory = new TickerFactory($tickerRepository, $tickerValidator);
});

it("should create a ticker class", function () {
    $ticker = $this->factory->create("ticker");
    expect($ticker)->toBeInstanceOf(Ticker::class);
});
