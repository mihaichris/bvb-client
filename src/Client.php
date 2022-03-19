<?php

namespace BVB;

use BVB\ClientConfigTrait;
use BVB\Domain\Ticker\Ticker;
use BVB\Domain\Ticker\TickerFactoryInterface;
use BVB\Domain\Ticker\TickerInfo;

class Client implements ClientInterface
{
    use ClientConfigTrait {
        ClientConfigTrait::__construct as private __clientConfigTrait;
    }

    private TickerFactoryInterface $factory;

    public function __construct()
    {
        $this->__clientConfigTrait();
        $this->initServiceContainer();
        $this->factory = $this->getTickerFactory();
    }

    public function getTicker(string $ticker): Ticker
    {
        return $this->factory->create($ticker);
    }

    public function getTickerPrice(string $ticker): float
    {
        $ticker = $this->factory->create($ticker);
        return $ticker->getPrice();
    }

    public function getTickerInfo(string $ticker): TickerInfo
    {
        $ticker = $this->factory->create($ticker);
        return $ticker->getInfo();
    }
}
