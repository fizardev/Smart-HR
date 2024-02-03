<?php

use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\GetDataByIdController;
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
    Route::post('/organization/store/', [OrganizationController::class, 'store']);
    Route::put('/organization/update/{id}', [OrganizationController::class, 'update']);
    Route::get('/organization/get/{id}', [OrganizationController::class, 'getOrganization']);
    Route::get('/organization/delete/{id}', [OrganizationController::class, 'destroy']);
});
