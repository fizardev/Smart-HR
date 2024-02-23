<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Pages\CompanyController;
use App\Http\Controllers\Pages\DashboardController;
use App\Http\Controllers\Pages\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');
// Route::post('/', [AuthenticatedSessionController::class, 'store']);
Route::post('/', [AuthenticatedSessionController::class, 'store']);

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard
    Route::get("/dashboard", [DashboardController::class, 'index'])->name("dashboard");

    Route::prefix('dashboard')->group(function () {
        Route::get("/profile", [DashboardController::class, 'getDataUser'])->name("profile");
        Route::get("/users", [DashboardController::class, 'getDataUsers'])->name("user");
        Route::get("/company", [CompanyController::class, 'index'])->name("company");
        Route::get("/organizations", [DashboardController::class, 'getDataOrganizations'])->name("organization");
        Route::get("/job-level", [DashboardController::class, 'getDataJobLevels'])->name("job-level");
        Route::get("/job-position", [DashboardController::class, 'getDataJobPositions'])->name("job-position");
        Route::get("/employees", [DashboardController::class, 'getDataEmployees'])->name("employees");
        Route::get("/day-off", [DashboardController::class, 'getDataHolidays'])->name("day-off");
        Route::get("/attendance-codes", [DashboardController::class, 'getDataAttendanceCodes'])->name("attendance-codes");
        Route::get("/shifts", [DashboardController::class, 'getDataShifts'])->name("shifts");
        Route::get("/banks", [DashboardController::class, 'getDataBanks'])->name("banks");
        Route::get("/bank-employees", [DashboardController::class, 'getDataBankEmployees'])->name("bank-employees");
        Route::get("/structures", [DashboardController::class, 'getDataStructures'])->name("structures");
        Route::get("/management-shift", [DashboardController::class, 'getManagementShift'])->name("management-shift");
    });

    Route::prefix('employee')->group(function () {
        Route::get("/day-off-requests", [DashboardController::class, 'dayOffRequest'])->name("day-off-requests");
    });
});

require __DIR__ . '/auth.php';
require __DIR__ . '/default-menu.php';
