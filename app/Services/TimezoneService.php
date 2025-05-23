<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TimezoneService
{
    protected $countryCoords = [
        'philippines' => ['lat' => 14.5995, 'lng' => 120.9842],
        'ph' => ['lat' => 14.5995, 'lng' => 120.9842],
        'usa' => ['lat' => 37.7749, 'lng' => -122.4194],
        'us' => ['lat' => 37.7749, 'lng' => -122.4194],
        'japan' => ['lat' => 35.6895, 'lng' => 139.6917],
        'jp' => ['lat' => 35.6895, 'lng' => 139.6917],
        'uk' => ['lat' => 51.5074, 'lng' => -0.1278],
        'gb' => ['lat' => 51.5074, 'lng' => -0.1278],
        'united kingdom' => ['lat' => 51.5074, 'lng' => -0.1278],
    ];

    public function getLatLngForCountry(string $country): ?array
    {
        $key = Str::lower(trim($country));
        return $this->countryCoords[$key] ?? null;
    }

    public function getTimezone(?float $lat, ?float $lng, ?string $country = null)
    {
        if (!$lat || !$lng) {
            if (!$country) {
                return [
                    'status' => 400,
                    'error' => 'Latitude and longitude or country are required',
                ];
            }

            $coords = $this->getLatLngForCountry($country);
            if (!$coords) {
                return [
                    'status' => 400,
                    'error' => 'Unsupported country',
                ];
            }

            $lat = $coords['lat'];
            $lng = $coords['lng'];
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
                    'error' => 'Timezone API returned error: ' . $response->body(),
                ];
            }

            $formatted = $this->formatTimezoneData($response->json());

            return [
                'status' => 200,
                'data' => $formatted,
            ];
        } catch (\Exception $e) {
            Log::error('Error fetching timezone: ' . $e->getMessage());
            return [
                'status' => 500,
                'error' => 'Failed to get timezone: ' . $e->getMessage(),
            ];
        }
    }

    protected function formatTimezoneData(array $data): array
    {
        return [
            'country' => $data['countryName'] ?? '',
            'city' => $data['cityName'] ?? '',
            'time' => $data['formatted'] ?? '',
        ];
    }
}
