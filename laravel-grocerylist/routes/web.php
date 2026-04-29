<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
// use App\Http\Controllers\CategoryController;

//items
Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
Route::post('/items', [ItemController::class, 'store'])->name('items.store');
Route::get('/items/{id}', function () {})->name('items.show');
Route::get('/items/{id}/edit', [ItemController::class, 'edit'])->name('items.edit');
Route::put('/items/{id}', [ItemController::class, 'update'])->name('items.update');
Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');

//other
Route::redirect('/', '/items');

Route::get('/welcome', function () {
    return view('welcome');
});
