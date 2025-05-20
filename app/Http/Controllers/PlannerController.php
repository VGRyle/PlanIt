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

        $response = $timezone->getTimezone($lat, $lng);

        return response()->json(
            $response['data'] ?? ['error' => $response['error']],
            $response['status']
        );
    }

    public function getHolidays($country, $year, CalendarService $calendar)
    {
        $response = $calendar->getHolidays($country, $year);

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
