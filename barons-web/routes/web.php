<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('news.show');
Route::get('/classes', [ClassController::class, 'index']);
Route::get('/bylaws', function () {
    return view('bylaws');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Direct logout endpoints (handles POST form and GET fallback safely)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/logout', [LoginController::class, 'logout']);

// Protected Routes (Requires Login)
Route::middleware('auth')->group(function () {
    // Static dashboard route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});