<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlannerController;

Route::middleware(['web', 'auth:sanctum'])->group(function () {
    Route::post('/task', [PlannerController::class, 'addTask']);
    Route::get('/tasks', [PlannerController::class, 'getTasks']);
    Route::delete('/tasks/{id}', [PlannerController::class, 'deleteTask']);
    Route::patch('/tasks/{id}/toggle', [PlannerController::class, 'toggleComplete']);

    Route::get('/weather/{city}', [PlannerController::class, 'getWeather']);
    Route::get('/timezone', [PlannerController::class, 'getTimezone']);
    Route::get('/holidays/{country}/{year}', [PlannerController::class, 'getHolidays']);    
    Route::get('/quote/motivation', [PlannerController::class, 'getMotivationalQuote']);
    Route::post('/planit/compile', [PlannerController::class, 'compilePlan']);
});