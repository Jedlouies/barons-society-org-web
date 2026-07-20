<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ClassController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('news.show');
Route::get('/classes', [ClassController::class, 'index']);
Route::get('/bylaws', function () {
    return view('bylaws');
});
