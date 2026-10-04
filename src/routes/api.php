<?php

use App\Http\Controllers\ContainerStatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('test', function () {
    return 'tests good';
});

Route::get('/containers', ContainerStatusController::class);
