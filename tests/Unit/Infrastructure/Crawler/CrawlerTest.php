<?php

use BVB\Infrastructure\Crawler\Crawler;
use BVB\Infrastructure\Http\Client\HttpClient;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\DomCrawler\Crawler as SymfonyCrawler;

beforeEach(function () {
    $this->httpClient = mock(HttpClient::class);
});

it('should return an instance of Crawler', function () {
    $crawler = new Crawler($this->httpClient->expect());
    $this->assertInstanceOf(Crawler::class, $crawler);
});

it('should return a symfony crawler with success', function () {
    /** @var Mock $responseInterface */
    $responseInterface = mock(ResponseInterface::class);
    $responseInterface = $responseInterface->expect(
        getBody: fn () => 'website',
    );
    $httpClient = $this->httpClient->expect(
        get: fn () => $responseInterface
    );
    $crawler = new Crawler($httpClient);
    $this->assertInstanceOf(SymfonyCrawler::class, $crawler->crawl('website'));
});
