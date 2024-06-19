<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\TemperatureController;

Route::middleware('check.token')->group(function () {
  Route::get('/api/v1/temperature', [TemperatureController::class, 'getDailyTemperature']);
});