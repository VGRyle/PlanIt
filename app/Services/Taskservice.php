<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function getAllTasks()
    {
        return Task::orderBy('due_date')->get();
    }

    public function createTask(array $data)
    {
        return Task::create([
            'content' => $data['content'],
            'description' => $data['description'] ?? null,
            'due_date' => $data['due_date'] ?? null,
            'is_completed' => false,
        ]);
    }

    public function deleteTask(int $id): bool
    {
        $task = Task::find($id);
        if (!$task) return false;
        $task->delete();
        return true;
    }

    public function toggleComplete(int $id)
    {
        $task = Task::find($id);
        if (!$task) return null;
        $task->is_completed = !$task->is_completed;
        $task->save();
        return $task->is_completed;
    }
}
