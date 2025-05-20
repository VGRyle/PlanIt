<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CalendarService
{
    public function getHolidays($country, $year)
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
                    'error' => 'Calendar API returned no data or error: ' . $response->body()
                ];
            }

            return [
                'status' => 200,
                'data' => $response->json()
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
