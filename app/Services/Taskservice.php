<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function getAllTasks()
    {
        return Task::orderBy('due_date')->get();
    }

    public function createTask(array $data): array
    {
        $task = Task::create([
            'content' => $data['content'],
            'description' => $data['description'] ?? null,
            'due_date' => $data['due_date'] ?? null,
            'is_completed' => false,
        ]);

        return [
            'status' => 201,
            'data' => $task,
        ];
    }

    public function deleteTask(int $id): array
    {
        $task = Task::find($id);
        if (!$task) {
            return [
                'status' => 404,
                'error' => 'Task not found',
            ];
        }

        $task->delete();

        return [
            'status' => 200,
            'data' => ['message' => 'Task deleted successfully'],
        ];
    }

    public function toggleComplete(int $id): array
    {
        $task = Task::find($id);
        if (!$task) {
            return [
                'status' => 404,
                'error' => 'Task not found',
            ];
        }

        $task->is_completed = !$task->is_completed;
        $task->save();

        return [
            'status' => 200,
            'data' => ['is_completed' => $task->is_completed],
        ];
    }
}
