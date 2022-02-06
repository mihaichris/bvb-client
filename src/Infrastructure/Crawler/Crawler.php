<?php

namespace BVB\Infrastructure\Crawler;

use Exception;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DomCrawler\Crawler as SymfonyCrawler;

class Crawler
{
    private const RESPONSE_SUCCESS = 200;
    private HttpClientInterface $client;
    private SymfonyCrawler $crawler;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function crawl(string $website)
    {
        $response = $this->findWebSite($website);
        $this->crawler = new SymfonyCrawler($response->getContent());
        return $this->crawler;
    }

    private function findWebSite(string $website): ResponseInterface
    {
        $response = $this->client->request('GET', $website);
        if (self::RESPONSE_SUCCESS !== $response->getStatusCode()) {
            throw new Exception("Error requesting data from website");
        }
        return $response;
    }
}
