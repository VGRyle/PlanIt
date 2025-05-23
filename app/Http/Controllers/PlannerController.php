<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodoistService;
use App\Services\WeatherService;
use App\Services\TimezoneService;
use App\Services\CalendarService;
use App\Services\FavQsService;
use App\Services\PlanItService;
use App\Models\Task;

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
        $lat = $request->input('lat');
        $lng = $request->input('lng');
        $country = $request->input('country');

        $response = $timezone->getTimezone($lat, $lng, $country);

        if ($response['status'] !== 200) {
            return response()->json(['error' => $response['error'] ?? 'Unknown error'], $response['status']);
        }

        $data = $response['data'];
        $result = [
            'country' => $data['countryName'] ?? '',
            'city' => $data['cityName'] ?? '',
            'time' => $data['formatted'] ?? '',
        ];

        return response()->json($result, 200);
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

    public function getTasks()
    {
        $tasks = Task::orderBy('due_date')->get();
        return response()->json($tasks);
    }

    public function storeTask(Request $request)
    {
        $request->validate([
            'content' => 'required|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        $task = Task::create($request->only('content', 'description', 'due_date'));

        return response()->json($task, 201);
    }

    public function deleteTask($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted']);
    }

    public function toggleComplete($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        $task->is_completed = !$task->is_completed;
        $task->save();

        return response()->json(['success' => true, 'is_completed' => $task->is_completed]);
    }
}
