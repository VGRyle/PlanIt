<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TodoistService
{
    public function createTask($text)
{
    $response = Http::withHeaders([
    'Authorization' => 'Bearer ' . env('TODOIST_API_KEY'),
    'Content-Type' => 'application/json',
])->post('https://api.todoist.com/rest/v2/tasks', [
    'content' => $text
]);

    return [
        'status' => $response->status(),
        'body' => $response->json(),
        'error' => $response->body()
    ];
}

}

