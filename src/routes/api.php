<?php

use App\Http\Controllers\ContainerRestartController;
use App\Http\Controllers\ContainerStatusController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\UpdateStatusController;
use Illuminate\Support\Facades\Route;

Route::middleware('docker-api-key')->group(function () {
    Route::get('/containers', ContainerStatusController::class);
    Route::post(
        '/containers/{container}/restart',
        ContainerRestartController::class
    );

    Route::post('/updates', UpdateController::class);
    Route::get('/updates/{updateId}', UpdateStatusController::class);
});
