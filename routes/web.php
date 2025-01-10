<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('pages.home');
Route::get('/geojson', [HomeController::class, 'getGeoJSON']);

Route::get('/team', [TeamController::class, 'index'])->name('pages.team');

