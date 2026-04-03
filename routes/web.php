<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\BookController;
use App\Http\Controllers\Web\BorrowController;
use App\Http\Controllers\Web\MemberController;

Route::get('/', [BookController::class, 'index'])->name('home');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'doRegister'])->name('do_register');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin'])->name('do_login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/books', [BookController::class, 'index'])->name('books.index');

Route::middleware('auth')->group(function () {

    Route::middleware('role:member')->group(function () {
        Route::post('/borrow/{book}', [BorrowController::class, 'borrow'])->name('borrow');
        Route::get('/my-borrows', [BorrowController::class, 'myBorrows'])->name('my-borrows');
        Route::get('/profile', [MemberController::class, 'profile'])->name('member.profile');
        Route::get('/profile/edit', [MemberController::class, 'edit'])->name('member.edit');
        Route::post('/profile/update', [MemberController::class, 'update'])->name('member.update');
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/roles', [AdminController::class, 'rolesPage'])->name('admin.roles');
        Route::get('/admin/create-librarian', [AdminController::class, 'createLibrarian'])->name('admin.create-librarian');
        Route::get('/librarians', [AdminController::class, 'librarians'])->name('librarians.index');
        Route::post('/admin/store-librarian', [AdminController::class, 'storeLibrarian'])->name('admin.store-librarian');
        Route::get('/admin/analysis', [AdminController::class, 'analysis'])->name('admin.analysis');
    });

    Route::middleware('role:admin,librarian')->group(function () {
        Route::get('/members', [AdminController::class, 'members'])->name('members.index');

        Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
        Route::post('/books/store', [BookController::class, 'store'])->name('books.store');

        Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
        Route::post('/books/{book}/update', [BookController::class, 'update'])->name('books.update');

        Route::post('/books/{book}/delete', [BookController::class, 'destroy'])->name('books.delete');
    });
});