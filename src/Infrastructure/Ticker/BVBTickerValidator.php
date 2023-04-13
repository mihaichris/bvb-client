<?php

namespace BVB\Infrastructure\Ticker;

use Exception;
use BVB\Domain\Ticker\TickerValidator;
use BVB\Infrastructure\Http\Client\HttpClient;
use Psr\Http\Client\ClientExceptionInterface;

class BVBTickerValidator implements TickerValidator
{
    public function __construct(private HttpClient $httpClient)
    {
    }

    /**
     * @throws Exception
     * @throws ClientExceptionInterface
     */
    public function exists(string $ticker): bool
    {
        $response = $this->httpClient->get("https://price.easybiny.com/price.php?sym={$ticker}");
        $content = json_decode((string)$response->getBody(), true);
        if ($content['RON'] === 'NA') {
            return false;
        }
        return true;
    }
}
