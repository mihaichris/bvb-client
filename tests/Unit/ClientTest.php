<?php

namespace BVB;

use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    private Client $client;

    protected function setUp(): void
    {
        parent::__construct();
        $this->client = new Client();
    }

    public function test_get_ticker_is_not_null()
    {
        $this->assertNotNull($this->client);
    }
}
