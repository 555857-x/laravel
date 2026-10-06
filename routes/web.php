<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::view('/about', 'about')->name('about');

Route::view('/education', 'education')->name('education');

// Satu resource route menghubungkan aksi CRUD ke ProjectController.
Route::resource('projects', ProjectController::class);