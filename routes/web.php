<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

Route::get('/', function () {
    return view('welcome');
});

// Ticket Routes
Route::get('/tickets/search', [TicketController::class, 'search'])->name('tickets.search');
Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');
Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');