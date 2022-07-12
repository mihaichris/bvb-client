<?php

namespace BVB\Infrastructure\Crawler;

use BVB\Infrastructure\Http\Client\HttpClient;
use Symfony\Component\DomCrawler\Crawler as SymfonyCrawler;

class Crawler
{
    private SymfonyCrawler $crawler;
    private HttpClient $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function crawl(string $website): SymfonyCrawler
    {
        $response = $this->httpClient->get($website);
        $content = json_decode($response->getBody(), true);
        $this->crawler = new SymfonyCrawler($content);
        return $this->crawler;
    }
}
