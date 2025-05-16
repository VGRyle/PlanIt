<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FavQsService
{
    protected $apiKey;
    protected $baseUrl = 'https://favqs.com/api';

    public function __construct()
    {
        $this->apiKey = config('services.favqs.key');
    }

    // Get Quote of the Day (no API key required)
    public function getQuoteOfTheDay()
    {
        $response = Http::get("{$this->baseUrl}/qotd");

        if ($response->successful()) {
            return $response->json()['quote'];
        }

        return null;
    }

    // Search Quotes by Tag (needs API key)
    public function searchQuotes($filter = 'inspiration')
    {
        $response = Http::withHeaders([
            'Authorization' => 'Token token=' . $this->apiKey
        ])->get("{$this->baseUrl}/quotes", [
            'filter' => $filter,
            'type' => 'tag'
        ]);

        if ($response->successful()) {
            return $response->json()['quotes'];
        }

        return [];
    }
}
