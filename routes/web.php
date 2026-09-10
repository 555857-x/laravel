<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});->name('hello-world');

Route::get('/hello-world', function () {
    return '<h1>haloooooo</h1>';
});->name('hello')

Route::get('hello/{name', function ($name = "tanpa nama") {
    return 'hello' . $name;
})->name('hello')

Route::redirect('/kosong', route('welcome'));

