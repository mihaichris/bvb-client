<?php

namespace BVB;

use BVB\Infrastructure\Ticker\TickerFactory;
use DI\Container;
use DI\ContainerBuilder;

trait ClientConfigTrait
{
    private ContainerBuilder $builder;
    protected Container $container;

    public function __construct()
    {
        $this->builder = new ContainerBuilder();
    }

    private function initServiceContainer(): void
    {
        $this->addParameters();
        $this->addServices();
        $this->container = $this->builder->build();
    }

    private function addParameters(): void
    {
        $this->builder->addDefinitions(__DIR__ . '/config/parameters.php');
    }

    private function addServices(): void
    {
        $this->builder->addDefinitions(__DIR__ . '/config/services.php');
    }

    private function getTickerFactory(): TickerFactory
    {
        return $this->container->get(TickerFactory::class);
    }
}
