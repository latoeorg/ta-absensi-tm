<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengajuanCutiController;
use App\Http\Controllers\ReportCutiController;

// Set root page to QR code generation page
// Route::get('/', [QrCodeController::class, 'generate'])
//     ->name('qr.generate')
//     ->middleware('auth');

Route::resource('/', AttendanceController::class);

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

// QR Code
Route::get('/generate-qr', [QrCodeController::class, 'generate'])
    ->name('qr.generate')
    ->middleware('auth');
Route::get('/scan-qr', [QrCodeController::class, 'scan'])
    ->name('attendance.scan')
    ->middleware('auth');

// Other routes
Route::middleware('auth')->group(function () {
    Route::resource('/user', UserController::class);
    Route::resource('/pengajuan-cuti', PengajuanCutiController::class);
    Route::resource('/report-cuti', ReportCutiController::class);

    Route::get('/update-profile', [UserController::class, 'editProfile'])->name('update-profile');
    Route::get('/attendance/all', [AttendanceController::class, 'allAttendance'])->name('attendance.all');
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance/clock-in', [AttendanceController::class, 'clockIn'])->name('attendance.clock-in');
    Route::post('/attendance/clock-out', [AttendanceController::class, 'clockOut'])->name('attendance.clock-out');
});
