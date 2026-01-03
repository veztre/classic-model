<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\EmployeeController;

// Root: send unauthenticated users to login, authenticated users to dashboard
Route::get('/', function () {
    return Auth::check() ? redirect()->route('employee.dashboard') : redirect()->route('login');
});

// Authentication routes (login/logout)
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'store'])->name('login.store');
});

// Protected routes: only accessible when authenticated
Route::middleware('auth')->group(function () {
    // Employee dashboard
    Route::get('/dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');

    // Application resource routes
    Route::resource('customers', CustomerController::class);
    Route::get('customers/{customer}/orders', [CustomerController::class, 'orders'])->name('customers.orders');
    Route::resource('products', ProductController::class);
    Route::resource('offices', OfficeController::class);
    Route::resource('orders', OrderController::class);
    Route::get('orders/{order}/pdf', [OrderController::class, 'generatePdf'])->name('orders.pdf');
    Route::resource('employees', EmployeeController::class)->only(['index', 'show']);

    // Logout
    Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'destroy'])->name('logout');
});
