<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilmesController;
use Illuminate\Support\Facades\Route;

// Rotas públicas (usuário pode ver filmes)
Route::get('/filmes', [FilmesController::class, 'index'])->name('filmes.index');
Route::get('/filmes/{filme}', [FilmesController::class, 'show'])->name('filmes.show');

// Rotas de administração
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/filmes/create', [FilmesController::class, 'create'])->name('filmes.create');
    Route::post('/filmes', [FilmesController::class, 'store'])->name('filmes.store');
    Route::get('/filmes/{filme}/edit', [FilmesController::class, 'edit'])->name('filmes.edit');
    Route::put('/filmes/{filme}', [FilmesController::class, 'update'])->name('filmes.update');
    Route::delete('/filmes/{filme}', [FilmesController::class, 'destroy'])->name('filmes.destroy');
});

// Autenticação
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
