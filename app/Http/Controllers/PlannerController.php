<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodoistService;
use App\Services\WeatherService;
use App\Services\TimezoneService;
use App\Services\CalendarService;
use App\Services\FavQsService;
use App\Services\PlanItService;

class PlannerController extends Controller
{
    public function addTask(Request $request, TodoistService $todoist)
    {
        $response = $todoist->createTask($request->input('content'));

        return response()->json(
            $response['data'] ?? ['error' => $response['error']],
            $response['status']
        );
    }

    public function getWeather($city, WeatherService $weather)
    {
        $response = $weather->getWeather($city);

        return response()->json(
            $response['data'] ?? ['error' => $response['error']],
            $response['status']
        );
    }

    public function getTimezone(Request $request, TimezoneService $timezone)
{
    $lat = $request->input('lat');
    $lng = $request->input('lng');
    $country = $request->input('country');

    // If lat/lng are missing, try to get them from the country input
    if (!$lat || !$lng) {
        if (!$country) {
            return response()->json(['error' => 'Latitude/Longitude or Country is required'], 400);
        }

        $coords = $this->getLatLngForCountry($country);
        if (!$coords) {
            return response()->json(['error' => 'Unsupported country'], 400);
        }

        $lat = $coords['lat'];
        $lng = $coords['lng'];
    }

    $response = $timezone->getTimezone($lat, $lng);

    // Extract only important info
    if (isset($response['data']) && $response['status'] === 200) {
        $data = $response['data'];
        $result = [
            'country' => $data['countryName'] ?? '',
            'city' => $data['cityName'] ?? '',
            'time' => $data['formatted'] ?? '',
        ];
        return response()->json($result, 200);
    }

    return response()->json(['error' => $response['error'] ?? 'Unknown error'], $response['status']);
}
private function getLatLngForCountry($country)
{
    $country = strtolower(trim($country));

    $map = [
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

    return $map[$country] ?? null;
}


public function getHolidays($country, $year, CalendarService $calendar)
{
    $month = request()->query('month'); // from query string ?month=5
    $response = $calendar->getHolidays($country, $year, $month);

    return response()->json(
        $response['data'] ?? ['error' => $response['error']],
        $response['status']
    );
}


    public function getMotivationalQuote(FavQsService $favqs)
    {
        $response = $favqs->getQuoteOfTheDay();

        return response()->json(
            $response['data'] ?? ['error' => $response['error']],
            $response['status']
        );
    }
    public function compilePlan(Request $request, PlanItService $planIt)
    {
        $response = $planIt->compilePlan(
            $request->input('content'),
            $request->input('city'),
            $request->input('lat'),
            $request->input('lng'),
            $request->input('country'),
            $request->input('year')
        );

        return response()->json($response['data'], $response['status']);
    }
}
