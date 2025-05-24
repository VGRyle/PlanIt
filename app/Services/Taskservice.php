<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function getAllTasks()
    {
         return Task::where('user_id', auth()->id())->get();
    }

    public function createTask(array $data): array
{
    $task = Task::create([
        'content' => $data['content'],
        'description' => $data['description'] ?? null,
        'due_date' => $data['due_date'] ?? null,
        'is_completed' => false,
        'user_id' => auth()->id(), // ✅ Add this line
    ]);

    return [
        'status' => 201,
        'data' => $task,
    ];
}

    public function deleteTask($id)
{
    $task = Task::where('id', $id)
                ->where('user_id', auth()->id()) // ✅ Match user
                ->first();

    if (!$task) {
        return ['error' => 'Task not found or unauthorized', 'status' => 404];
    }

    $task->delete();

    return ['data' => ['message' => 'Task deleted'], 'status' => 200];
}


    public function toggleComplete($id)
{
    $task = Task::where('id', $id)
                ->where('user_id', auth()->id()) // ✅ Important!
                ->first();

    if (!$task) {
        return ['error' => 'Task not found or unauthorized', 'status' => 404];
    }

    $task->is_completed = !$task->is_completed;
    $task->save();

    return ['data' => $task, 'status' => 200];
}
}
