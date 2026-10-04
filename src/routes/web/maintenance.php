<?php

use App\Http\Controllers\Maintenance\Backup\BackupIndexController;
use App\Http\Controllers\Maintenance\Backup\BackupSettingsController;
use App\Http\Controllers\Maintenance\Backup\DeleteBackupController;
use App\Http\Controllers\Maintenance\Backup\DownloadBackupController;
use App\Http\Controllers\Maintenance\Backup\RunBackupController;
use App\Http\Controllers\Maintenance\Backup\UploadBackupController;
use App\Http\Controllers\Maintenance\Logs\DownloadLogController;
use App\Http\Controllers\Maintenance\Logs\LogSettingsController;
use App\Http\Controllers\Maintenance\Logs\LogsIndexController;
use App\Http\Controllers\Maintenance\Logs\ViewLogController;
use Illuminate\Support\Facades\Route;

/**
 * Routes for Application Maintenance
 */
Route::middleware('auth.secure')->prefix('maintenance')->name('maint.')->group(function () {
    /*
    |---------------------------------------------------------------------------
    | Logging and Log Settings
    | /maintenance/logs
    |---------------------------------------------------------------------------
    */
    Route::prefix('logs')->name('logs.')->group(function () {
        Route::controller(LogSettingsController::class)
            ->name('settings.')
            ->group(function () {
                Route::get('settings', 'show')
                    ->name('show')
                    ->breadcrumb('Log Settings', 'maint.logs.index');
                Route::put('settings', 'update')->name('update');
            });

        Route::get('{channel}/{logFile}/download', DownloadLogController::class)
            ->name('download');
        Route::get('{channel}/{logFile}', ViewLogController::class)
            ->name('show')
            ->breadcrumb('View Log', 'maint.logs.index');
        Route::get('/{channel?}', LogsIndexController::class)
            ->name('index')
            ->breadcrumb('Logs', 'admin.index');
    });
});
