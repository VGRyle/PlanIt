<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TodoistService
{
    public function createTask($text)
    {
        return Http::withToken(env('TODOIST_API_TOKEN'))
            ->post('https://api.todoist.com/rest/v2/tasks', [
                'content' => $text
            ])->json();
    }
}
