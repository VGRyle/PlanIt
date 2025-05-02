<?php

namespace App\Http\Controllers;

use App\Services\TodoistService;
use App\Services\WeatherService;
use Illuminate\Http\Request;

class PlannerController extends Controller
{
    public function addTask(Request $request, TodoistService $todoist)
    {
        return response()->json(
            $todoist->createTask($request->input('content'))
        );
    }

    public function weather($city, WeatherService $weather)
    {
        return response()->json(
            $weather->today($city)
        );
    }
}
