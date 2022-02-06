<?php

namespace BVB\Tests\Features;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class BaseTestCase extends TestCase
{
    private HttpClientInterface $client;

    public function __construct()
    {
        parent::__construct();
        $this->client = HttpClient::create();
    }

    public function get(string $url): ResponseInterface
    {
        return $this->client->request('GET', $url);
    }
}
