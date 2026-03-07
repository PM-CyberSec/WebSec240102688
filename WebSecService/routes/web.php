<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.master');
});

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/even', function () {
    return view('even'); //even.blade.php
});
Route::get('/prime', function () {
    return view('prime'); //prime.blade.php
});

Route::get('/multable/{j?}', function ($j = 5) {
    $j = (int) $j;
    return view('multable', compact('j')); //multable.blade.php
});
