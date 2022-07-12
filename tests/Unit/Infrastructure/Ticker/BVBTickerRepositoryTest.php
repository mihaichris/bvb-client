<?php

use BVB\Infrastructure\Http\Client\HttpClient;
use BVB\Infrastructure\Ticker\BVBTickerRepository;
use Pest\Mock\Mock;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

it('should throw exception if data not found', function (string $ticker) {
    /** @var ResponseInterface $response */
    $response = mock(ResponseInterface::class);
    $response = $response->expect(
        getBody: fn () => '{"s":"no_data"}'
    );
    /** @var Mock $httpClient */
    $httpClient = mock(HttpClient::class);
    $httpClient = $httpClient->expect(
        get: fn () => $response
    );

    /** @var ClientInterface $client */
    $bvbTickerRepository = new BVBTickerRepository('tickerHistoryUrl', 'tickerSymbolUrl', $httpClient);
    $bvbTickerRepository->getLastClosed($ticker);
})->with(['ticker'])->expectExceptionMessage('No data found');
