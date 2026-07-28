<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FinancialController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/classes', [ClassController::class, 'index']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::middleware(['auth', 'supabase.session'])->group(function () {
    Route::get('/member-classes', [ClassController::class, 'index2']);
    Route::get('/bylaws', function () {
        return view('bylaws');
    });
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('news.show');

    Route::get('/financial', [FinancialController::class, 'index'])->name('financial');
    Route::post('/financial/transaction', [FinancialController::class, 'store'])->name('financial.store');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/announcements', [DashboardController::class, 'storeAnnouncement'])->name('announcements.store');
    Route::post('/members', [DashboardController::class, 'storeMember'])->name('members.store');
    Route::post('/classes', [DashboardController::class, 'storeClass'])->name('classes.store');
    
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/logout', [LoginController::class, 'logout']);
});