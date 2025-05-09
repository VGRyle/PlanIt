<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CalendarService
{
    public function getHolidays($country, $year)
    {
        return Http::get('https://calendarific.com/api/v2/holidays', [
            'api_key' => env('CALENDARIFIC_API_KEY'),
            'country' => $country,
            'year' => $year
        ])->json();
    }
}
