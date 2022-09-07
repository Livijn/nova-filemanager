<?php


use Stepanenko3\NovaFilemanager\Http\Controllers\DiskController;
use Stepanenko3\NovaFilemanager\Http\Controllers\FileController;
use Stepanenko3\NovaFilemanager\Http\Controllers\FolderController;
use Stepanenko3\NovaFilemanager\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

Route::as('nova-filemanager.')->middleware('nova')->group(static function () {
    Route::get('/', IndexController::class)->name('data');

    Route::prefix('disks')->as('disks.')->group(static function () {
        Route::get('available', [DiskController::class, 'available'])->name('available');
    });

    Route::prefix('files')->as('files.')->group(function () {
        Route::post('upload', [FileController::class, 'upload'])->name('upload');
        Route::post('rename', [FileController::class, 'rename'])->name('rename');
        Route::post('delete', [FileController::class, 'delete'])->name('delete');
        Route::get('download', [FileController::class, 'download'])->name('download');
    });

    Route::prefix('folders')->as('folders.')->group(function () {
        Route::post('create', [FolderController::class, 'create'])->name('create');
        Route::post('rename', [FolderController::class, 'rename'])->name('rename');
        Route::post('delete', [FolderController::class, 'delete'])->name('delete');
    });
});
