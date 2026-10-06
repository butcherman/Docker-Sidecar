<?php

use App\Http\Controllers\ContainerRestartController;
use App\Http\Controllers\ContainerStatusController;
use Illuminate\Support\Facades\Route;

Route::middleware('docker-api-key')->group(function () {
    Route::get('/containers', ContainerStatusController::class);
    Route::post(
        '/containers/{container}/restart',
        ContainerRestartController::class
    );
});
