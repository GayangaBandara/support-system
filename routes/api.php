<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\TicketController as APITicketController;

Route::prefix('v1')->group(function () {
    Route::get('/tickets', [APITicketController::class, 'index']);
    Route::post('/tickets', [APITicketController::class, 'store']);
});
