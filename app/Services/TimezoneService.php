<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TimezoneService
{
    public function getTimezone($lat, $lng)
    {
        return Http::get('https://api.timezonedb.com/v2.1/get-time-zone', [
            'key' => env('TIMEZONE_API_KEY'),
            'format' => 'json',
            'by' => 'position',
            'lat' => $lat,
            'lng' => $lng
        ])->json();
    }
}
