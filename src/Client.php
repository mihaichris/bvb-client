<?php

namespace BVB;

use BVB\ClientConfigTrait;
use BVB\Domain\Ticker\Ticker;
use BVB\Domain\Ticker\TickerFactory;

class Client
{
    use ClientConfigTrait {
        ClientConfigTrait::__construct as private __clientConfigTrait;
    }

    private TickerFactory $factory;

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
}
