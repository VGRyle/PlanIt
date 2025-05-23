<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodoistService;
use App\Services\WeatherService;
use App\Services\TimezoneService;
use App\Services\CalendarService;
use App\Services\FavQsService;
use App\Services\PlanItService;
use App\Services\TaskService;

class PlannerController extends Controller
{
    public function addTask(Request $request)
    {
        $request->validate([
            'content' => 'required|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        $task = Task::create($request->only('content', 'description', 'due_date') + ['is_completed' => false]);

        return response()->json([
            'local_task' => $task,
        ], 201);
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
        $response = $timezone->getTimezone(
            $request->input('lat'),
            $request->input('lng'),
            $request->input('country')
        );

        return response()->json(
            $response['data'] ?? ['error' => $response['error'] ?? 'Unknown error'],
            $response['status']
        );
    }

    public function getHolidays($country, $year, CalendarService $calendar)
    {
        $month = request()->query('month');
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

    public function getTasks(TaskService $taskService)
    {
        $tasks = $taskService->getAllTasks();
        return response()->json($tasks);
    }

    public function deleteTask($id, TaskService $taskService)
    {
        $response = $taskService->deleteTask($id);

        if (isset($response['error'])) {
            return response()->json(['error' => $response['error']], $response['status']);
        }

        return response()->json($response['data'], $response['status']);
    }

    public function toggleComplete($id, TaskService $taskService)
    {
        $response = $taskService->toggleComplete($id);

        if (isset($response['error'])) {
            return response()->json(['error' => $response['error']], $response['status']);
        }

        return response()->json($response['data'], $response['status']);
    }
}
