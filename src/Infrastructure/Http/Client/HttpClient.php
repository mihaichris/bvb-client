<?php

namespace BVB\Infrastructure\Http\Client;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;

class HttpClient
{
    private ClientInterface $client;
    private RequestFactoryInterface $requestFactory;

    public function __construct(ClientInterface $client, RequestFactoryInterface $requestFactory)
    {
        $this->client = $client;
        $this->requestFactory = $requestFactory;
    }

    /** @throws ClientExceptionInterface */
    public function get(string $uri): ResponseInterface
    {
        $request = $this->requestFactory->createRequest('GET', $uri);
        return $this->client->sendRequest($request);
    }
}
