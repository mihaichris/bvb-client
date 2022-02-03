<?php

namespace BVB;

use DI\Container;
use BVB\ClientConfigTrait;
use PHPUnit\Framework\TestCase;

/**
 * @covers ClientConfigTrait
 */
class ClientConfigTraitTest extends TestCase
{
    use ClientConfigTrait {
        ClientConfigTrait::__construct as private __clientConfigTrait;
    }

    public function __construct()
    {
        parent::__construct();
        $this->__clientConfigTrait();
        $this->initServiceContainer();
    }


    public function test_on_init_service_container_will_not_be_null()
    {
        $this->assertNotNull($this->container);
    }

    public function test_on_init_service_container_will_be_container_class()
    {
        $this->assertInstanceOf(Container::class, $this->container);
    }
}
