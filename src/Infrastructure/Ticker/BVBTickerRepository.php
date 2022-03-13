<?php

namespace BVB\Infrastructure\Ticker;

use BVB\Domain\Ticker\TickerInfo;
use BVB\Domain\Ticker\TickerRepository;
use Carbon\Carbon;
use Exception;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BVBTickerRepository implements TickerRepository
{
    private const CLOSED_KEY = "c";
    private const STATUS_KEY = "s";
    private const STATUS_NO_DATA = "no_data";
    private static string $tickerHistoryUrl;
    private static string $tickerSymbolUrl;
    private HttpClientInterface $client;

    public function __construct(string $tickerHistoryUrl, string $tickerSymbolUrl, HttpClientInterface $client)
    {
        self::$tickerHistoryUrl = $tickerHistoryUrl;
        self::$tickerSymbolUrl = $tickerSymbolUrl;
        $this->client = $client;
    }

    /** @throws Exception */
    public function getLastClosed(string $ticker): float
    {
        $unixStartDate = Carbon::yesterday()->timestamp;
        $unixEndDate = Carbon::now()->timestamp;
        $tickerHistoryUrl = $this->buildTickerHistoryUrl($ticker, $unixStartDate, $unixEndDate);
        $response = $this->get($tickerHistoryUrl);
        if (self::STATUS_NO_DATA === $response[self::STATUS_KEY]) {
            throw new Exception("No data found");
        }
        return end($response[self::CLOSED_KEY]);
    }

    public function getTickerInfo(string $ticker): TickerInfo
    {
        $tickerSymbolUrl = $this->buildTickerSymbolUrl($ticker);
        $response = $this->get($tickerSymbolUrl);
        $companyName = $response['description'] ?? "";
        $description = $response['industry'] ?? "";
        return new TickerInfo($companyName, $description, $ticker);
    }

    /** @return array<mixed> */
    private function get(string $url): array
    {
        $response = $this->client->request('GET', $url);
        return json_decode($response->getContent(), true);
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
