<?php

use BVB\Infrastructure\Ticker\BVBTickerRepository;
use Pest\Mock\Mock;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

it('should throw exception if data not found', function (string $ticker) {
    /** @var Mock $responseInterface */
    $responseInterface = mock(ResponseInterface::class);
    $responseInterface = $responseInterface->expect(
        getBody: fn () => '{"s":"no_data"}'
    );
    /** @var Mock $requestInterface */
    $requestInterface = mock(RequestInterface::class);
    $requestInterface = $requestInterface->expect();
    /** @var Mock $client */
    $client = mock(ClientInterface::class);
    $requestFactory = mock(RequestFactoryInterface::class);
    $client = $client->expect(
        sendRequest: fn () => $responseInterface
    );
    $requestFactory = $requestFactory->expect(
        createRequest: fn () => $requestInterface
    );
    /** @var ClientInterface $client */
    $bvbTickerRepository = new BVBTickerRepository('tickerHistoryUrl', 'tickerSymbolUrl', $client, $requestFactory);
    $bvbTickerRepository->getLastClosed($ticker);
})->with(['ticker'])->expectExceptionMessage('No data found');
