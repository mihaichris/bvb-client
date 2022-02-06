<?php

namespace BVB\Infrastructure\Ticker;

use Carbon\Carbon;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TickerHistoryRepository
{
    private static string $tickerHistoryUrl;
    private HttpClientInterface $client;

    public function __construct(string $tickerHistoryUrl, HttpClientInterface $client)
    {
        self::$tickerHistoryUrl = $tickerHistoryUrl;
        $this->client = $client;
    }

    public function getLastClosed(string $ticker): float
    {
        $unixStartDate = Carbon::yesterday()->timestamp;
        $unixEndDate = Carbon::now()->timestamp;
        $response = $this->client->request('GET', $this->buildTickerHistoryUrl($ticker, $unixStartDate, $unixEndDate));
        $decodedResponse = json_decode($response->getContent(), true);
        return end($decodedResponse['c']);
    }

    private function buildTickerHistoryUrl(string $ticker, int $unixStartDate, int $unixEndDate): string
    {
        return sprintf(self::$tickerHistoryUrl, $ticker, $unixStartDate, $unixEndDate);
    }
}
