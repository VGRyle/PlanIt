<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TimezoneService
{
    public function getTimezone($lat, $lng)
    {
        $apiKey = env('TIMEZONEDB_API_KEY');
        \Log::info('API Key: ' . $apiKey);

        $response = Http::get('http://api.timezonedb.com/v2.1/get-time-zone', [
            'key' => $apiKey,
            'format' => 'json',
            'by' => 'position',
            'lat' => $lat,
            'lng' => $lng,
        ]);

        return $response->json();  // Return the response in JSON format
    }

}