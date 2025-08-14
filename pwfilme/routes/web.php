<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\FilmesController;
use App\Http\Controllers\FavoritosController;
use App\Http\Controllers\TMDBController;
use Illuminate\Support\Facades\Route;

// Rotas de administração
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/filmes/create', [FilmesController::class, 'create'])->name('filmes.create');
    Route::post('/filmes', [FilmesController::class, 'store'])->name('filmes.store');
    Route::get('/filmes/{filme}/edit', [FilmesController::class, 'edit'])->name('filmes.edit');
    Route::put('/filmes/{filme}', [FilmesController::class, 'update'])->name('filmes.update');
    Route::delete('/filmes/{filme}', [FilmesController::class, 'destroy'])->name('filmes.destroy');
    Route::get('/categorias', [CategoriasController::class, 'index'])->name('categorias.index');
    Route::get('/categorias/create', [CategoriasController::class, 'create'])->name('categorias.create');
    Route::post('/categorias', [CategoriasController::class, 'store'])->name('categorias.store');
    Route::get('/categorias/{categoria}/edit', [CategoriasController::class, 'edit'])->name('categorias.edit');
    Route::put('/categorias/{categoria}', [CategoriasController::class, 'update'])->name('categorias.update');
    Route::delete('/categorias/{categoria}', [CategoriasController::class, 'destroy'])->name('categorias.destroy');
});

// Rotas públicas (usuário pode ver filmes)
Route::get('/filmes', [FilmesController::class, 'index'])->name('filmes.index');
Route::get('/filmes/{filme}', [FilmesController::class, 'show'])->name('filmes.show');

// Rotas de favoritos (usuários autenticados)
Route::middleware(['auth'])->group(function () {
    Route::get('/favoritos', [FavoritosController::class, 'index'])->name('favoritos.index');
    Route::post('/favoritos/{filme}/toggle', [FavoritosController::class, 'toggle'])->name('favoritos.toggle');
    Route::delete('/favoritos/{filme}', [FavoritosController::class, 'destroy'])->name('favoritos.destroy');
});

Route::get('/', [FilmesController::class, 'home'])->name('home');

// Autenticação
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
