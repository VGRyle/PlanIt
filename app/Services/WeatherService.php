<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WeatherService
{
    public function getWeather($city)
    {
        if (!$city) {
            return [
                'status' => 400,
                'error' => 'No city provided'
            ];
        }

        try {
            $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
                'q' => $city,
                'appid' => env('WEATHER_API_KEY')
            ]);

            if ($response->failed()) {
                return [
                    'status' => $response->status(),
                    'error' => 'Weather API returned no data or error: ' . $response->body()
                ];
            }

            return [
                'status' => 200,
                'data' => $response->json()
            ];
        } catch (\Exception $e) {
            Log::error('Error fetching weather: ' . $e->getMessage());
            return [
                'status' => 500,
                'error' => 'Failed to get weather: ' . $e->getMessage()
            ];
        }
    }
}
