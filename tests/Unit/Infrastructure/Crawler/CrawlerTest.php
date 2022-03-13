<?php

use BVB\Infrastructure\Crawler\Crawler;
use Symfony\Component\DomCrawler\Crawler as SymfonyCrawler;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

beforeEach(function () {
    $this->httpClient = mock(HttpClientInterface::class);
});

it('should return an instance of Crawler', function () {
    $crawler = new Crawler($this->httpClient->expect());
    $this->assertInstanceOf(Crawler::class, $crawler);
});

it('should return a symfony crawler with success', function () {
    /** @var Mock $responseInterface */
    $responseInterface = mock(ResponseInterface::class);
    $responseInterface = $responseInterface->expect(
        getContent: fn () => 'website',
        getStatusCode: fn () => 200
    );
    $httpClient = $this->httpClient->expect(
        request: fn () => $responseInterface
    );
    $crawler = new Crawler($httpClient);
    $this->assertInstanceOf(SymfonyCrawler::class, $crawler->crawl('website'));
});


it('should throw an exception when fail symfony crawler', function () {
    /** @var Mock $responseInterface */
    $responseInterface = mock(ResponseInterface::class);
    $responseInterface = $responseInterface->expect(
        getStatusCode: fn () => 500
    );
    $httpClient = $this->httpClient->expect(
        request: fn () => $responseInterface
    );
    $crawler = new Crawler($httpClient);
    $crawler->crawl('website');
})->expectExceptionMessage("Error requesting data from website");
