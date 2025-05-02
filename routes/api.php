<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlannerController;

Route::post('/task', [PlannerController::class, 'addTask']);
Route::get('/weather/{city}', [PlannerController::class, 'weather']);
