<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CalendarService
{
    public function getHolidays($country, $year, $month = null)
{
    if (!$country || !$year) {
        return [
            'status' => 400,
            'error' => 'Country and year required'
        ];
    }

    try {
        $response = Http::get('https://calendarific.com/api/v2/holidays', [
            'api_key' => env('CALENDARIFIC_API_KEY'),
            'country' => $country,
            'year' => $year
        ]);

        if ($response->failed()) {
            return [
                'status' => $response->status(),
                'error' => 'Calendar API error: ' . $response->body()
            ];
        }

        $holidays = $response->json()['response']['holidays'];

        // Filter by month if provided
        if ($month) {
            $holidays = array_filter($holidays, function ($holiday) use ($month) {
                $date = $holiday['date']['iso'] ?? null;
                return $date && date('n', strtotime($date)) == $month;
            });

            $holidays = array_values($holidays); // reset array keys
        }

        return [
            'status' => 200,
            'data' => $holidays
        ];
    } catch (\Exception $e) {
        Log::error('Error fetching holidays: ' . $e->getMessage());
        return [
            'status' => 500,
            'error' => 'Failed to get holidays: ' . $e->getMessage()
        ];
    }
}
}
