<?php

use BVB\Domain\Ticker\TickerFactory;
use BVB\Infrastructure\Ticker\BVBTickerRepository;
use DI\Container;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

use function DI\get;
use function DI\create;

return [
    HttpClientInterface::class => function (Container $container) {
        return HttpClient::create($container->get('http.client.defaultParameters'));
    },
    TickerFactory::class => create()->constructor(get(BVBTickerRepository::class)),
    BVBTickerRepository::class => create()
        ->constructor(
            get('bvb.api.ticker.historyUrl'),
            get('bvb.api.ticker.symbolUrl'),
            get(HttpClientInterface::class)
        )
];
