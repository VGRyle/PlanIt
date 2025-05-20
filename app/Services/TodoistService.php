<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TodoistService
{
    public function createTask($content)
    {
        if (!$content) {
            return [
                'status' => 400,
                'error' => 'No content provided'
            ];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('TODOIST_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.todoist.com/rest/v2/tasks', [
                'content' => $content
            ]);

            if ($response->failed()) {
                return [
                    'status' => $response->status(),
                    'error' => 'Todoist API returned error: ' . $response->body()
                ];
            }

            return [
                'status' => 200,
                'data' => $response->json()
            ];

        } catch (\Exception $e) {
            Log::error('Error adding task: ' . $e->getMessage());
            return [
                'status' => 500,
                'error' => 'Failed to add task: ' . $e->getMessage()
            ];
        }
    }
}
