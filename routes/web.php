<?php

use Inertia\Inertia;
use App\Jobs\ClearBills;
use Facades\App\Support\Markdown;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController;

Route::get('/', function () {
    ClearBills::dispatch();

    return Inertia::render('Welcome/Show');
})->name('welcome');

Route::middleware('throttle:3,10')->post('/bills', [BillController::class, 'store'])->name('bills.store');
Route::get('/bills/{bill}', [BillController::class, 'show'])->name('bills.show');

Route::get('/guide', function () {
    return Inertia::render('Guide/Show', [
        'content' => Markdown::localizedMarkdownPath('guide.md'),
    ]);
})->name('guide');
