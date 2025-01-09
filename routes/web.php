<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, 'home'])->name('home');

Route::get('/carte', [MainController::class, 'map'])->name('map');
Route::get('/department', [MainController::class, 'department'])->name('department');
Route::get('/api', [ApiController::class, 'index']);
