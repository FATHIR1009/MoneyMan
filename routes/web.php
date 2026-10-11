<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('login');
    Route::get('/transactions/create', function () {
        return view('transactions.create');
    })->name('transactions.create');

    Route::get('/transactions/{id}', function ($id) {
        return view('transactions.show');
    })->name('transactions.show');

    Route::get('/transactions/{id}/edit', function ($id) {
        return view('transactions.edit');
    })->name('transactions.edit');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/transactions/create', function () {
        return view('transactions.create');
    })->name('transactions.create');

    Route::get('/transactions/{id}', function ($id) {
        return view('transactions.show');
    })->name('transactions.show');

    Route::get('/transactions/{id}/edit', function ($id) {
        return view('transactions.edit');
    })->name('transactions.edit');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Temporary dashboard route
        Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/wallets', function () {
        return view('wallets.index');
    })->name('wallets.index');

    Route::get('/transactions', function () {
        return view('transactions.index');
    })->name('transactions.index');

    Route::get('/settings', function () {
        return view('settings.index');
    })->name('settings.index');
    Route::get('/transactions/create', function () {
        return view('transactions.create');
    })->name('transactions.create');

    Route::get('/transactions/{id}', function ($id) {
        return view('transactions.show');
    })->name('transactions.show');

    Route::get('/transactions/{id}/edit', function ($id) {
        return view('transactions.edit');
    })->name('transactions.edit');
});
