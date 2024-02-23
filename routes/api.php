<?php

use App\Http\Controllers\API\AttendanceCodeController;
use App\Http\Controllers\API\AttendanceController;
use App\Http\Controllers\API\BankController;
use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\DayOffController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\JobLevelController;
use App\Http\Controllers\API\JobPositionController;
use App\Http\Controllers\API\OrganizationController;
use App\Http\Controllers\API\ShiftController;
use App\Http\Controllers\API\BankEmployeeController;
use App\Http\Controllers\API\DayOffRequestController;
use App\Http\Controllers\API\StructureController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\RoleController;
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
    Route::put('/clock-in', [AttendanceController::class, 'clock_in']);
    Route::put('/clock-out', [AttendanceController::class, 'clock_out']);
    Route::post('/management-shift/store', [AttendanceController::class, 'import']);
    //company
    Route::post('/company/{id}', [CompanyController::class, 'update']);
    //organization
    Route::prefix('organization')->group(function () {
        Route::post('/store', [OrganizationController::class, 'store']);
        Route::put('/update/{id}', [OrganizationController::class, 'update']);
        Route::get('/get/{id}', [OrganizationController::class, 'getOrganization']);
        Route::get('/delete/{id}', [OrganizationController::class, 'destroy']);
    });
    Route::prefix('role')->group(function () {
        Route::get('/get/{id}', [RoleController::class, 'getRole']);
        Route::post('/store', [RoleController::class, 'store']);
        Route::put('/update/{id}', [RoleController::class, 'update']);
        Route::get('/delete/{id}', [RoleController::class, 'destroy']);
    });
    Route::prefix('user')->group(function () {
        Route::post('/store', [UserController::class, 'store']);
        Route::put('/update/{id}', [UserController::class, 'update']);
        Route::put('/update-akses/{user:id}', [UserController::class, 'updateRole']);
        Route::get('/get/{id}', [UserController::class, 'getUser']);
        Route::get('/delete/{id}', [UserController::class, 'destroy']);
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
    Route::prefix('attendance-codes')->group(function () {
        Route::post('/store', [AttendanceCodeController::class, 'store']);
        Route::put('/update/{id}', [AttendanceCodeController::class, 'update']);
        Route::get('/get/{id}', [AttendanceCodeController::class, 'getAttendanceCode']);
        Route::get('/delete/{id}', [AttendanceCodeController::class, 'destroy']);
    });
    Route::prefix('shifts')->group(function () {
        Route::post('/store', [ShiftController::class, 'store']);
        Route::put('/update/{id}', [ShiftController::class, 'update']);
        Route::get('/get/{id}', [ShiftController::class, 'getShift']);
        Route::get('/delete/{id}', [ShiftController::class, 'destroy']);
    });
    Route::prefix('banks')->group(function () {
        Route::post('/store', [BankController::class, 'store']);
        Route::put('/update/{id}', [BankController::class, 'update']);
        Route::get('/get/{id}', [BankController::class, 'getBank']);
        Route::get('/delete/{id}', [BankController::class, 'destroy']);
    });
    Route::prefix('bank-employees')->group(function () {
        Route::post('/store', [BankEmployeeController::class, 'store']);
        Route::put('/update/{id}', [BankEmployeeController::class, 'update']);
        Route::get('/get/{id}', [BankEmployeeController::class, 'getBankEmployee']);
        Route::get('/delete/{id}', [BankEmployeeController::class, 'destroy']);
    });
    Route::prefix('structures')->group(function () {
        Route::post('/store', [StructureController::class, 'store']);
        Route::put('/update/{id}', [StructureController::class, 'update']);
        Route::get('/get/{id}', [StructureController::class, 'getStructure']);
        Route::get('/delete/{id}', [StructureController::class, 'destroy']);
    });
});

Route::prefix('employee')->group(function () {
    Route::prefix('request/day-off', [DayOffRequestController::class, 'store']);
});
