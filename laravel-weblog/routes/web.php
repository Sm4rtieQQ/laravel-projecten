<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;

Route::redirect('/', '/articles');

Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'show')->name('login');
    Route::post('/login', 'authenticate')->name('user.auth');
    Route::post('/logout', 'logout')->middleware('auth')->name('logout');
    Route::get('/dashboard', 'dashboard')->middleware('auth')->name('dashboard');
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'store')->name('user.store');
});

Route::controller(ArticleController::class)->group(function () {
    Route::get('/articles', 'index')->name('articles.index');
    Route::get('/articles/create', 'create')->middleware('auth')->name('articles.create');
    Route::get('/articles/{article}', 'show')->name('articles.show');
    Route::get('/articles/{article}/edit', 'edit')->middleware('auth')->name('articles.edit');
    Route::post('/articles', 'store')->middleware('auth')->name('articles.store');
    Route::put('/articles/{article}', 'update')->middleware('auth')->name('articles.update');
    Route::delete('/articles/{article}', 'destroy')->middleware('auth')->name('articles.destroy');
});

Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

Route::controller(CommentController::class)->group(function () {
    Route::post('/articles/{article}', 'store')->middleware('auth')->name('comments.store');
    Route::delete('/articles/{article}/{comment}', 'destroy')->middleware('auth')->name('comments.destroy');
});
