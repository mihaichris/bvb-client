<?php

use BVB\Infrastructure\Http\Client\HttpClient;
use BVB\Infrastructure\Ticker\BVBTickerRepository;
use BVB\Infrastructure\Ticker\TickerFactory;
use DI\Container;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\HttpFactory;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;

use function DI\autowire;
use function DI\get;
use function DI\create;

return [
    ClientInterface::class => function (Container $container) {
        return new Client($container->get('http.client.defaultParameters'));
    },
    RequestFactoryInterface::class => autowire(HttpFactory::class),
    UriFactoryInterface::class => autowire(HttpFactory::class),
    HttpClient::class => autowire(HttpClient::class),
    BVBTickerRepository::class => create()
        ->constructor(
            get('bvb.api.ticker.historyUrl'),
            get('bvb.api.ticker.symbolUrl'),
            get(HttpClient::class)
        ),
    TickerFactory::class => create()
        ->constructor(get(BVBTickerRepository::class)),
];
