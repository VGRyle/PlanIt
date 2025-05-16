<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodoistService;
use App\Services\WeatherService;
use App\Services\TimezoneService;
use App\Services\CalendarService;
use App\Services\RemindersService;
use Illuminate\Support\Facades\Log;

class PlannerController extends Controller
{
    public function addTask(Request $request, TodoistService $todoist)
    {
        $content = $request->input('content');

        if (!$content) {
            return response()->json(['error' => 'No content provided'], 400);
        }

        try {
            $result = $todoist->createTask($content);

            if (!$result) {
                return response()->json(['error' => 'Todoist API returned empty response'], 502);
            }

            return response()->json([
                'message' => 'Task added successfully',
                'data' => $result
            ]);
        } catch (\Exception $e) {
            Log::error('Error adding task: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to add task', 'details' => $e->getMessage()], 500);
        }
    }

    public function getWeather($city, WeatherService $weather)
    {
        if (!$city) {
            return response()->json(['error' => 'No city provided'], 400);
        }

        try {
            $result = $weather->getWeather($city);

            if (!$result) {
                return response()->json(['error' => 'Weather API returned no data'], 502);
            }

            return response()->json([
                'message' => 'Weather data retrieved successfully',
                'data' => $result
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching weather: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to get weather', 'details' => $e->getMessage()], 500);
        }
    }

    public function getTimezone(Request $request, TimezoneService $timezone)
    {
        $lat = $request->input('lat');
        $lng = $request->input('lng');

        if (!$lat || !$lng) {
            return response()->json(['error' => 'Latitude and longitude required'], 400);
        }

        try {
            $result = $timezone->getTimezone($lat, $lng);

            if (!$result) {
                return response()->json(['error' => 'Timezone API returned no data'], 502);
            }

            return response()->json([
                'message' => 'Timezone retrieved successfully',
                'data' => $result
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching timezone: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to get timezone', 'details' => $e->getMessage()], 500);
        }
    }

    public function getHolidays($country, $year, CalendarService $calendar)
    {
        if (!$country || !$year) {
            return response()->json(['error' => 'Country and year required'], 400);
        }

        try {
            $result = $calendar->getHolidays($country, $year);

            if (!$result) {
                return response()->json(['error' => 'Calendar API returned no data'], 502);
            }

            return response()->json([
                'message' => 'Holidays retrieved successfully',
                'data' => $result
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching holidays: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to get holidays', 'details' => $e->getMessage()], 500);
        }
    }
}

