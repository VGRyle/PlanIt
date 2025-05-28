<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Public landing page for everyone (guests and users)
    Route::get('/', function () {
    return view('welcome'); // This shows login/register for guests
    })->name('home');

// Authenticated dashboard (your main app)
    Route::get('/dashboard', function () {
    return view('index'); // Your custom dashboard view
    })->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes (still protected by auth)
    Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes (login, register, etc.)
require __DIR__.'/auth.php';



//BROOOO WHERE