<?php

use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\DayOffController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\GetDataByIdController;
use App\Http\Controllers\API\JobLevelController;
use App\Http\Controllers\API\JobPositionController;
use App\Http\Controllers\API\OrganizationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('dashboard')->group(function () {
    //company
    Route::post('/company/{id}', [CompanyController::class, 'update']);
    //organization
    Route::prefix('organization')->group(function () {
        Route::post('/store', [OrganizationController::class, 'store']);
        Route::put('/update/{id}', [OrganizationController::class, 'update']);
        Route::get('/get/{id}', [OrganizationController::class, 'getOrganization']);
        Route::get('/delete/{id}', [OrganizationController::class, 'destroy']);
    });
    Route::prefix('job-level')->group(function () {
        Route::post('/store', [JobLevelController::class, 'store']);
        Route::put('/update/{id}', [JobLevelController::class, 'update']);
        Route::get('/get/{id}', [JobLevelController::class, 'getJobLevel']);
        Route::get('/delete/{id}', [JobLevelController::class, 'destroy']);
    });
    Route::prefix('job-position')->group(function () {
        Route::post('/store', [JobPositionController::class, 'store']);
        Route::put('/update/{id}', [JobPositionController::class, 'update']);
        Route::get('/get/{id}', [JobPositionController::class, 'getJobPosition']);
        Route::get('/delete/{id}', [JobPositionController::class, 'destroy']);
    });
    Route::prefix('employee')->group(function () {
        Route::post('/store', [EmployeeController::class, 'store']);
        Route::put('/update/{id}', [EmployeeController::class, 'update']);
        Route::get('/get/{id}', [EmployeeController::class, 'getJobPosition']);
        Route::get('/delete/{id}', [EmployeeController::class, 'destroy']);
    });
    Route::prefix('day-off')->group(function () {
        Route::post('/store', [DayOffController::class, 'store']);
        Route::put('/update/{id}', [DayOffController::class, 'update']);
        Route::get('/get/{id}', [DayOffController::class, 'getHoliday']);
        Route::get('/delete/{id}', [DayOffController::class, 'destroy']);
    });
});
