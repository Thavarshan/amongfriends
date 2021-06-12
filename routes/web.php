<?php

use Inertia\Inertia;
use App\Jobs\ClearBills;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController;

Route::get('/', function () {
    ClearBills::dispatch();

    return Inertia::render('Welcome/Show');
})->name('welcome');
// middleware('throttle:3,10')->
Route::post('/bills', [BillController::class, 'store'])->name('bills.store');
Route::get('/bills/{bill}', [BillController::class, 'show'])->name('bills.show');
