<?php

use App\Http\Controllers\Api\Task\ChangeStatusController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\AuthController;

use App\Http\Controllers\Api\Task\DestroyController;
use App\Http\Controllers\Api\Task\IndexController;
use App\Http\Controllers\Api\Task\ShowController;
use App\Http\Controllers\Api\Task\StoreController;
use App\Http\Controllers\Api\Task\UpdateController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group(['middleware' => ['jwt.auth'], 'prefix' => 'tasks', 'as' => 'tasks.'], function () {
    Route::group(['middleware' => 'check.task.author'], function () {
        Route::get('/{task}', ShowController::class)->name('show');
        Route::delete('/{task}', DestroyController::class)->name('destroy');
        Route::match(['put', 'patch'], '/{task}', UpdateController::class)->name('update');
        Route::patch('/{task}/change-status', ChangeStatusController::class)->name('status.change');
    });
    Route::get('/', IndexController::class)->name('index');
    Route::post('/', StoreController::class)->name('store');
});
