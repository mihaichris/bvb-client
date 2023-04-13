<?php

namespace BVB;

use BVB\Infrastructure\Ticker\TickerFactory;
use DI\Container;
use DI\ContainerBuilder;

trait ClientConfigTrait
{
    private ContainerBuilder $containerBuilder;
    protected Container $container;

    public function __construct()
    {
        $this->containerBuilder = new ContainerBuilder();
    }

    private function initServiceContainer(): void
    {
        $this->addParameters();
        $this->addServices();
        $this->container = $this->containerBuilder->build();
    }

    private function addParameters(): void
    {
        $this->containerBuilder->addDefinitions(__DIR__ . '/config/parameters.php');
    }

    private function addServices(): void
    {
        $this->containerBuilder->addDefinitions(__DIR__ . '/config/services.php');
    }

    private function getTickerFactory(): TickerFactory
    {
        return $this->container->get(TickerFactory::class);
    }
}
