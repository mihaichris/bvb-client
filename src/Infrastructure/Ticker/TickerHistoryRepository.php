<?php

namespace BVB\Infrastructure\Ticker;

use Carbon\Carbon;
use Exception;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TickerHistoryRepository
{
    private const CLOSED_KEY = "c";
    private const STATUS_KEY = "s";
    private const STATUS_NO_DATA = "no_data";
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
        if (self::STATUS_NO_DATA === $decodedResponse[self::STATUS_KEY]) {
            throw new Exception("Ticker not found");
        }
        return end($decodedResponse[self::CLOSED_KEY]);
    }

    private function buildTickerHistoryUrl(string $ticker, int $unixStartDate, int $unixEndDate): string
    {
        return sprintf(self::$tickerHistoryUrl, $ticker, $unixStartDate, $unixEndDate);
    }
}
