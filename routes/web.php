<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/wallets', function () {
        return view('wallets.index');
    })->name('wallets.index');

    Route::get('/transactions', function () {
        return view('transactions.index');
    })->name('transactions.index');

    Route::get('/transactions/create', function () {
        return view('transactions.create');
    })->name('transactions.create');

    Route::get('/transactions/{id}', function ($id) {
        return view('transactions.show');
    })->name('transactions.show');

    Route::get('/transactions/{id}/edit', function ($id) {
        return view('transactions.edit');
    })->name('transactions.edit');

    Route::get('/settings', function () {
        return view('settings.index');
    })->name('settings.index');
});
