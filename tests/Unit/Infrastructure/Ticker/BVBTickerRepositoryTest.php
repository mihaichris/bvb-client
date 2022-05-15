<?php

use BVB\Infrastructure\Http\Client\HttpClient;
use BVB\Infrastructure\Ticker\BVBTickerRepository;
use Pest\Mock\Mock;
use Psr\Http\Client\ClientInterface;

it('should throw exception if data not found', function (string $ticker) {
    /** @var Mock $httpClient */
    $httpClient = mock(HttpClient::class);
    $httpClient = $httpClient->expect(
        get: fn () => json_decode('{"s":"no_data"}', true)
    );

    /** @var ClientInterface $client */
    $bvbTickerRepository = new BVBTickerRepository('tickerHistoryUrl', 'tickerSymbolUrl', $httpClient);
    $bvbTickerRepository->getLastClosed($ticker);
})->with(['ticker'])->expectExceptionMessage('No data found');
