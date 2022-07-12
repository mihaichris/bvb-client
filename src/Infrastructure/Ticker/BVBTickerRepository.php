<?php

namespace BVB\Infrastructure\Ticker;

use BVB\Domain\Ticker\TickerInfo;
use BVB\Domain\Ticker\TickerRepository;
use BVB\Infrastructure\Http\Client\HttpClient;
use Carbon\Carbon;
use Exception;

class BVBTickerRepository implements TickerRepository
{
    private const CLOSED_KEY = "c";
    private const STATUS_KEY = "s";
    private const STATUS_NO_DATA = "no_data";
    private static string $tickerHistoryUrl;
    private static string $tickerSymbolUrl;
    private HttpClient $httpClient;

    public function __construct(
        string $tickerHistoryUrl,
        string $tickerSymbolUrl,
        HttpClient $httpClient
    ) {
        self::$tickerHistoryUrl = $tickerHistoryUrl;
        self::$tickerSymbolUrl = $tickerSymbolUrl;
        $this->httpClient = $httpClient;
    }

    /** @throws Exception */
    public function getLastClosed(string $ticker): float
    {
        $unixStartDate = Carbon::yesterday()->timestamp;
        $unixEndDate = Carbon::now()->timestamp;
        $tickerHistoryUrl = $this->buildTickerHistoryUrl($ticker, $unixStartDate, $unixEndDate);
        $response = $this->httpClient->get($tickerHistoryUrl);
        $content = json_decode($response->getBody(), true);
        if (self::STATUS_NO_DATA === $content[self::STATUS_KEY]) {
            throw new Exception("No data found");
        }
        return end($content[self::CLOSED_KEY]);
    }

    public function getTickerInfo(string $ticker): TickerInfo
    {
        $tickerSymbolUrl = $this->buildTickerSymbolUrl($ticker);
        $response = $this->httpClient->get($tickerSymbolUrl);
        $content = json_decode($response->getBody(), true);
        $companyName = $content['description'] ?? "";
        $description = $content['industry'] ?? "";
        return new TickerInfo($companyName, $description, $ticker);
    }

    private function buildTickerHistoryUrl(
        string $ticker,
        float|string|int $unixStartDate,
        float|string|int $unixEndDate
    ): string {
        return sprintf(self::$tickerHistoryUrl, $ticker, $unixStartDate, $unixEndDate);
    }

    private function buildTickerSymbolUrl(string $ticker): string
    {
        return sprintf(self::$tickerSymbolUrl, $ticker);
    }
}
