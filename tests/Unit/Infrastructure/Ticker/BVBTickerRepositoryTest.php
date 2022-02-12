<?php

use BVB\Infrastructure\Ticker\BVBTickerRepository;
use Pest\Mock\Mock;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

it('should throw exception if data not found', function (string $ticker) {
    /** @var Mock $responseInterface */
    $responseInterface = mock(ResponseInterface::class);
    $responseInterface = $responseInterface->expect(
        getContent: fn () => '{"s":"no_data"}'
    );
    /** @var Mock $client */
    $client = mock(HttpClientInterface::class);
    $client = $client->expect(
        request: fn () => $responseInterface
    );
    /** @var HttpClientInterface $client */
    $bvbTickerRepository = new BVBTickerRepository('tickerHistoryUrl', 'tickerSymbolUrl', $client);
    $bvbTickerRepository->getLastClosed($ticker);
})->with(['ticker'])->expectExceptionMessage('No data found');
