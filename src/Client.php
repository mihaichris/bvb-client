<?php

namespace BVB;

use BVB\ClientConfigTrait;

class Client
{
    use ClientConfigTrait {
        ClientConfigTrait::__construct as private __clientConfigTrait;
    }

    public function __construct()
    {
        $this->__clientConfigTrait();
        $this->initServiceContainer();
    }

    public function getTicker()
    {
    }
}
