<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function today($city)
    {
        return Http::get('http://api.weatherapi.com/v1/current.json', [
            'key' => env('WEATHER_API_KEY'),
            'q' => $city
        ])->json();
    }
}
