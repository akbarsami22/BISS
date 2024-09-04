<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[UserController::class,'login'])->name('login');
Route::get('/register',[UserController::class,'register'])->name('register');
Route::post('/register_process', [UserController::class, 'register_process'])->name('register_process');
Route::post('/login_process', [UserController::class, 'login_process'])->name('login_process');

Route::middleware(['user.auth'])->group(function () {
    Route::get('/books',[BookController::class,'books'])->name('books');
    Route::get('/add_book',[BookController::class,'add_book'])->name('add_book');
    Route::post('/add_book_process',[BookController::class,'add_book_process'])->name('add_book_process');
    Route::get('/edit_book/{id}',[BookController::class,'edit_book'])->name('edit_book');
    Route::put('/update_book/{id}',[BookController::class,'update_book'])->name('update_book');
    Route::delete('/delete_book/{id}',[BookController::class,'delete_book'])->name('delete_book');
    Route::get('/logout',[UserController::class,'user_logout'])->name('user_logout');
});





