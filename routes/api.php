<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlannerController;

Route::post('/task', [PlannerController::class, 'addTask']);
Route::get('/weather/{city}', [PlannerController::class, 'getWeather']);
Route::get('/timezone', [PlannerController::class, 'getTimezone']);
Route::get('/holidays/{country}/{year}', [PlannerController::class, 'getHolidays']);    
Route::get('/quote/motivation', [PlannerController::class, 'getMotivationalQuote']);
Route::post('/planit/compile', [PlannerController::class, 'compilePlan']);

Route::get('/tasks', [PlannerController::class, 'getTasks']);      // Get all tasks
Route::post('/tasks', [PlannerController::class, 'storeTask']);    // Add new task
Route::delete('/tasks/{id}', [PlannerController::class, 'deleteTask']); // Delete task by id
Route::patch('/tasks/{id}/toggle', [PlannerController::class, 'toggleComplete']);