<?php

use BVB\Domain\Ticker\TickerInfo;
use PHPUnit\Framework\TestCase;

it('should fail if instance with no parameters', function () {
    $tickerInfo = new TickerInfo();
})->expectException(Exception::class);

it('should fail validation with wrong name', function (string $name, string $description, string $ticker) {
    $tickerInfo = new TickerInfo($name, $description, $ticker);
})->with([''])->with(['description'])->with(['ticker'])->expectExceptionMessage('Name should not be null');

it('should fail validation with wrong ticker', function (string $name, string $description, string $ticker) {
    $tickerInfo = new TickerInfo($name, $description, $ticker);
})->with(['name'])->with(['description'])->with([''])->expectExceptionMessage('Ticker should not be null');

it('should not fail validation and return an instance of ticker info', function (string $name, string $description, string $ticker) {
    /** @var TestCase $this */
    $tickerInfo = new TickerInfo($name, $description, $ticker);
    $this->assertInstanceOf(TickerInfo::class, $tickerInfo);
})->with(['name'])->with(['description'])->with(['ticker']);

it('test get name', function (string $name, string $description, string $ticker) {
    /** @var TestCase $this */
    $tickerInfo = new TickerInfo($name, $description, $ticker);
    $this->assertEquals('name', $tickerInfo->getName());
})->with(['name'])->with(['description'])->with(['ticker']);

it('test get description', function (string $name, string $description, string $ticker) {
    /** @var TestCase $this */
    $tickerInfo = new TickerInfo($name, $description, $ticker);
    $this->assertEquals('description', $tickerInfo->getDescription());
})->with(['name'])->with(['description'])->with(['ticker']);

it('test get ticker', function (string $name, string $description, string $ticker) {
    /** @var TestCase $this */
    $tickerInfo = new TickerInfo($name, $description, $ticker);
    $this->assertEquals('ticker', $tickerInfo->getTicker());
})->with(['name'])->with(['description'])->with(['ticker']);
