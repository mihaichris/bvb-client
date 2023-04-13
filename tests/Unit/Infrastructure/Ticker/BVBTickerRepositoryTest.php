<?php

use BVB\Infrastructure\Http\Client\HttpClient;
use BVB\Infrastructure\Ticker\BVBTickerRepository;

it('should throw exception if something happens with the request', function () {
    $httpClient = Mockery::mock(HttpClient::class);
    $httpClient->shouldReceive("get")->andThrows(Exception::class);
    $bvbTickerRepository = new BVBTickerRepository($httpClient);
    $bvbTickerRepository->getLastClosed('ticker');
})->expectException(Exception::class);
