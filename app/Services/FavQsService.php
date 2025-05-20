<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FavQsService
{
    protected $apiKey;
    protected $baseUrl = 'https://favqs.com/api';

    public function __construct()
    {
        $this->apiKey = config('services.favqs.key');
    }

    public function getQuoteOfTheDay()
    {
        try {
            $response = Http::get("{$this->baseUrl}/qotd");

            if ($response->failed()) {
                return [
                    'status' => $response->status(),
                    'error' => 'Failed to retrieve quote: ' . $response->body()
                ];
            }

            return [
                'status' => 200,
                'data' => $response->json()['quote']
            ];
        } catch (\Exception $e) {
            Log::error('Error fetching quote: ' . $e->getMessage());
            return [
                'status' => 500,
                'error' => 'Failed to fetch quote: ' . $e->getMessage()
            ];
        }
    }
}
