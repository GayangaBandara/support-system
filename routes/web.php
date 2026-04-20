<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ReplyController;

// Home Page (NEW)
Route::get('/', function () {
    return view('home'); // 
});

// Keep welcome page (optional)
Route::get('/welcome', function () {
    return view('welcome');
});

// Ticket Routes
Route::get('/tickets/create', function () {
    return view('tickets.create');
})->name('tickets.create');

Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');

Route::get('/tickets/search', [TicketController::class, 'search'])->name('tickets.search');

Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');

// Reply Routes
Route::post('/tickets/{ticket}/replies', [ReplyController::class, 'store'])->name('replies.store');