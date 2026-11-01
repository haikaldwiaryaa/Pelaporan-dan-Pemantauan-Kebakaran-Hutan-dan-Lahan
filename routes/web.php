<?php

use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ForwardingController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/create', [ReportController::class, 'create'])->middleware('can:create-report')->name('reports.create');
    Route::post('/reports', [ReportController::class, 'store'])->middleware('can:create-report')->name('reports.store');
    Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');
    Route::get('/reports/{report}/edit', [ReportController::class, 'edit'])->middleware('can:create-report')->name('reports.edit');
    Route::put('/reports/{report}', [ReportController::class, 'update'])->middleware('can:create-report')->name('reports.update');
    Route::post('/reports/{report}/review', [ReviewController::class, 'store'])->middleware('can:review-report')->name('reports.review');
    Route::post('/reports/{report}/forward', [ForwardingController::class, 'store'])->middleware('can:forward-report')->name('reports.forward');
});