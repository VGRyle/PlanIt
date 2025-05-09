<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlannerController;

Route::post('/task', [PlannerController::class, 'addTask']);
Route::get('/weather/{city}', [PlannerController::class, 'getWeather']);
Route::post('/timezone', [PlannerController::class, 'getTimezone']);
Route::get('/holidays/{country}/{year}', [PlannerController::class, 'getHolidays']);
