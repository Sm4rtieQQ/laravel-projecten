<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/articles');

Route::get('/login', [UserController::class, 'show'])->name('user.login');
Route::post('/login', [UserController::class, 'authenticate'])->name('user.auth');
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth')->name('user.logout');
Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware('auth')->name('user.dashboard');

Route::get('/register', [RegisterController::class, 'show'])->name('user.register');
route::post('/register', [RegisterController::class, 'store'])->name('user.store');

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

Route::post('/articles/{article}', [CommentController::class, 'store'])->name('comments.store');
