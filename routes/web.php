<?php

use App\Http\Controllers\Web\ProductsController;
use App\Http\Controllers\Web\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.master');
});
Route::get('/home', function () {
    return view('welcome');
});
Route::get('/even', function () {
    return view('even');
});
Route::get('/prime', function () {
    return view('prime');
});
Route::get('/multable/{j?}', function ($j = 5) {
    $j = (int) $j;
    return view('multable', compact('j'));
});

Route::get('register', [UsersController::class, 'register'])->name('register');
Route::post('register', [UsersController::class, 'doRegister'])->name('do_register');

Route::get('login', [UsersController::class, 'login'])->name('login');
Route::post('login', [UsersController::class, 'doLogin'])->name('do_login');

Route::get('logout', [UsersController::class, 'doLogout'])->name('do_logout');

Route::get('/Products/create', [ProductsController::class, 'create'])->name('products.create');
Route::post('/Products', [ProductsController::class, 'store'])->name('products.store');
Route::get('/Products', [ProductsController::class, 'list'])->name('products.index');
