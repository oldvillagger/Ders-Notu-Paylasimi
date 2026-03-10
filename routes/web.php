<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::view('/', 'welcome')->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ServerController;
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [NoteController::class, 'index'])->name('dashboard');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('notes', [NoteController::class, 'store'])->name('notes.store');
    
    // Sunucu (Group/Discord) Rotaları
    Route::get('servers', [ServerController::class, 'index'])->name('servers.index');
    Route::post('servers', [ServerController::class, 'store'])->name('servers.store');
    Route::get('servers/{server}', [ServerController::class, 'show'])->name('servers.show');
    Route::post('servers/{server}/join', [ServerController::class, 'join'])->name('servers.join');
    Route::post('servers/{server}/message', [ServerController::class, 'message'])->name('servers.message');
});
