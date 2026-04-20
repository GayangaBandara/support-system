<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ReplyController;

Route::get('/', function () {
    return view('welcome');
});

// Ticket Routes
Route::get('/tickets/search', [TicketController::class, 'search'])->name('tickets.search');
Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');
Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');

// Reply Routes
Route::post('/tickets/{ticket}/replies', [ReplyController::class, 'store'])->name('replies.store');