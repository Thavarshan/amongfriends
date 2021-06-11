<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController;

Route::get('/', fn () => Inertia::render('Welcome/Show'))->name('welcome');
Route::post('/bills', [BillController::class, 'store'])->name('bills.store');
Route::get('/bills/{bill}', [BillController::class, 'show'])->name('bills.show');
