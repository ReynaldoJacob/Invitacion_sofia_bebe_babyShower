<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvitationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// --- Invitaciones (admin) ---
Route::get('/invitations',          [InvitationController::class, 'index']);
Route::post('/invitations',         [InvitationController::class, 'store']);
Route::get('/invitations/{linkId}', [InvitationController::class, 'show']);

// --- RSVP (invitado) ---
Route::post('/rsvp', [InvitationController::class, 'rsvp']);
