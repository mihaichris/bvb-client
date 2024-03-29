<?php

namespace BVB\Infrastructure\Ticker;

use BVB\Domain\Ticker\TickerRepository;
use BVB\Infrastructure\Http\Client\HttpClient;
use Exception;
use Psr\Http\Client\ClientExceptionInterface;

class BVBTickerRepository implements TickerRepository
{
    public function __construct(private HttpClient $httpClient)
    {
    }

    /**
     * @throws Exception
     * @throws ClientExceptionInterface
     */
    public function getLastClosed(string $ticker): float
    {
        $response = $this->httpClient->get("https://price.easybiny.com/price.php?sym={$ticker}");
        $content = json_decode((string)$response->getBody(), true);
        return $content['RON'];
    }
}
