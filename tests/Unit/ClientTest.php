<?php

namespace BVB\Tests\Unit;

use BVB\Client;
use BVB\Infrastructure\Ticker\BVBTicker;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    private Client $client;

    protected function setUp(): void
    {
        parent::__construct();
        $this->client = new Client();
    }

    public function test_get_client_is_not_null()
    {
        $this->assertNotNull($this->client);
    }

    public function test_get_client_is_client()
    {
        $this->assertInstanceOf(Client::class, $this->client);
    }

    public function test_get_ticker_without_parameter_will_return_excetion()
    {
        $this->expectError();
        $ticker = $this->client->getTicker();
    }

    public function test_get_ticker_is_not_null()
    {
        $ticker = $this->client->getTicker('TRP');
        $this->assertNotNull($ticker);
    }

    public function test_get_ticker_is_bvb_ticker()
    {
        $ticker = $this->client->getTicker('TRP');
        $this->assertInstanceOf(BVBTicker::class, $ticker);
    }

    public function test_get_ticker_price_is_not_null()
    {
        $ticker = $this->client->getTicker('TRP');
        $price = $ticker->getPrice();
        $this->assertNotNull($price);
    }

    public function test_get_ticker_price_is_float()
    {
        $ticker = $this->client->getTicker('TRP');
        $price = $ticker->getPrice();
        $this->assertIsFloat($price);
    }
}
