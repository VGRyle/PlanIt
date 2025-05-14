<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodoistService;
use App\Services\WeatherService;
use App\Services\TimezoneService;
use App\Services\CalendarService;
use App\Services\RemindersService;

class PlannerController extends Controller
{
    public function addTask(Request $request, TodoistService $todoist)
    {
        return response()->json($todoist->createTask($request->input('content')));
    }

    public function getWeather($city, WeatherService $weather)
    {
        return response()->json($weather->getWeather($city));
    }

    public function getTimezone(Request $request, TimezoneService $timezone)
    {
        return response()->json($timezone->getTimezone($request->lat, $request->lng));
    }
    public function getHolidays($country, $year, CalendarService $calendar)
    {
        return response()->json($calendar->getHolidays($country, $year));
    }
}
