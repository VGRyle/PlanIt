<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TimezoneService
{
    public function getTimezone($lat, $lng)
    {
        if (!$lat || !$lng) {
            return [
                'status' => 400,
                'error' => 'Latitude and longitude required'
            ];
        }

        try {
            $apiKey = env('TIMEZONEDB_API_KEY');

            $response = Http::get('http://api.timezonedb.com/v2.1/get-time-zone', [
                'key' => $apiKey,
                'format' => 'json',
                'by' => 'position',
                'lat' => $lat,
                'lng' => $lng,
            ]);

            if ($response->failed()) {
                return [
                    'status' => $response->status(),
                    'error' => 'Timezone API returned no data or error: ' . $response->body()
                ];
            }

            return [
                'status' => 200,
                'data' => $response->json()
            ];
        } catch (\Exception $e) {
            Log::error('Error fetching timezone: ' . $e->getMessage());
            return [
                'status' => 500,
                'error' => 'Failed to get timezone: ' . $e->getMessage()
            ];
        }
    }
}
