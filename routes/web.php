<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\QrCodeController;
// routes/web.php

Route::middleware('auth')->group(function () {
    Route::get('/attendance/all', [AttendanceController::class, 'allAttendance'])->name('attendance.all');
});

Route::get('/generate-qr', [QrCodeController::class, 'generate'])
    ->name('qr.generate')
    ->middleware('auth');
Route::get('/scan-qr', [QrCodeController::class, 'scan'])
    ->name('attendance.scan')
    ->middleware('redirect_if_not_authenticated');

// AUTH
Route::get('/login', [AuthController::class, 'index'])
    ->name('login')
    ->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->middleware('guest');
Route::get('/login-attendance', [AuthController::class, 'index'])
    ->name('login-attendance')
    ->middleware('guest');

Route::post('/login-attendance', [AuthController::class, 'authenticateAttendance'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout']);

// DASHBOARD
Route::resource('/', AttendanceController::class)->middleware('auth');

// USER MANAGEMENT
Route::resource('/user', UserController::class)->middleware('auth');

// PROFILE
Route::get('/update-profile', [UserController::class, 'editProfile'])
    ->name('update-profile')
    ->middleware('auth');

// ATTENDANCE
Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::post('/attendance/clock-in', [AttendanceController::class, 'clockIn'])->name('attendance.clock-in');
Route::post('/attendance/clock-out', [AttendanceController::class, 'clockOut'])->name('attendance.clock-out');
