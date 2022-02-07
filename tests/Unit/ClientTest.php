<?php

namespace BVB\Tests\Unit;

use BVB\Client;
use BVB\Infrastructure\Ticker\BVBTicker;

beforeEach(function () {
    $this->client = new Client();
});

test('client is not null', function () {
    $this->assertNotNull($this->client);
})->group('integration');

test('client is client instance', function () {
    $this->assertInstanceOf(Client::class, $this->client);
})->group('integration');

test('get ticker without parameter will get error', function () {
    $this->client->getTicker();
})->group('integration')->expectError();

test('ticker is not null when i give a ticker parameter', function (string $ticker) {
    $this->assertNotNull($this->client->getTicker($ticker));
})->with(['TRP', 'ALR', 'ONE', 'IMP'])->group('integration');

test('ticker is bvb ticker instance when i give a ticker parameter', function (string $ticker) {
    $this->assertInstanceOf(BVBTicker::class, $this->client->getTicker($ticker));
})->with(['TRP', 'ALR', 'ONE', 'IMP'])->group('integration');

it('should throw exception if ticker could provided could not be found', function () {
    $ticker = $this->client->getTicker('TEST');
    $ticker->getPrice();
})->group('integration')->expectExceptionMessage("Ticker not found");

test('ticker price is not null', function (string $ticker) {
    $ticker = $this->client->getTicker($ticker);
    $price = $ticker->getPrice();
    $this->assertNotNull($price);
})->with(['TRP', 'ALR', 'ONE', 'IMP'])->group('integration');

test('ticker price is float', function (string $ticker) {
    $ticker = $this->client->getTicker($ticker);
    $price = $ticker->getPrice();
    $this->assertIsFloat($price);
})->with(['TRP', 'ALR', 'ONE', 'IMP'])->group('integration');
