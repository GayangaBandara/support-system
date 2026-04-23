<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('home'))->name('home');
Route::get('/welcome', fn() => view('welcome'));

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');

// Logout MUST be POST (security best practice)
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Ticket (Customer)
|--------------------------------------------------------------------------
*/

Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
Route::get('/tickets/search', [TicketController::class, 'search'])->name('tickets.search');
Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');

/*
|--------------------------------------------------------------------------
| Reply Routes
|--------------------------------------------------------------------------
*/

Route::post('/tickets/{ticket}/replies', [ReplyController::class, 'store'])
    ->name('replies.store');

/*
|--------------------------------------------------------------------------
| Agent Routes (Protected)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('agent')->group(function () {
    
    Route::get('/tickets', [TicketController::class, 'index'])
        ->name('agent.tickets.index');

    Route::patch('/tickets/{id}/status', [TicketController::class, 'updateStatus'])
        ->name('agent.tickets.status');

});