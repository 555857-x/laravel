<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::view('/about', 'about')->name('about');

Route::view('/education', 'education')->name('education');

// Route tambahan harus di atas resource agar tidak dianggap projects/{project}.
Route::get('/projects/search', [ProjectController::class, 'search'])->name('projects.search');
Route::get('/projects/trash', [ProjectController::class, 'trash'])->name('projects.trash');
Route::patch('/projects/{id}/restore', [ProjectController::class, 'restore'])->name('projects.restore');
Route::delete('/projects/{id}/force-delete', [ProjectController::class, 'forceDelete'])->name('projects.forceDelete');

// Satu resource route menghubungkan aksi CRUD ke ProjectController.
Route::resource('projects', ProjectController::class);
