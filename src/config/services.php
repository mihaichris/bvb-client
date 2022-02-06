<?php

use function DI\get;
use function DI\create;

use BVB\Domain\Ticker\TickerFactory;
use BVB\Infrastructure\Crawler\Crawler;
use BVB\Infrastructure\Ticker\TickerHistoryRepository;
use DI\Container;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

return [
    HttpClientInterface::class => function (Container $container) {
        return HttpClient::create($container->get('http.client.defaultParameters'));
    },
    TickerFactory::class => create()->constructor(get(TickerHistoryRepository::class)),
    TickerHistoryRepository::class => create()
        ->constructor(get('bvb.api.ticker.historyUrl'), get(HttpClientInterface::class))
];
