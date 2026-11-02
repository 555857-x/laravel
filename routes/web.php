<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

// Halaman publik, bisa dibuka tanpa login.
Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/education', 'education')->name('education');

// Bawaan Breeze: dashboard dan pengaturan profil.
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Latihan: halaman khusus user login (admin maupun bukan).
    Route::view('/post/profile-saya', 'profile-saya')->name('profile.saya');
});

// Wajib login dan wajib admin. URL jadi /post/projects,
// nama route tetap projects.* supaya view lama tidak perlu diubah.
Route::prefix('post')->middleware(['auth', 'admin'])->group(function () {
    // Route tambahan harus di atas resource agar tidak dianggap projects/{project}.
    Route::get('/projects/search', [ProjectController::class, 'search'])->name('projects.search');
    Route::get('/projects/trash', [ProjectController::class, 'trash'])->name('projects.trash');
    Route::patch('/projects/{id}/restore', [ProjectController::class, 'restore'])->name('projects.restore');
    Route::delete('/projects/{id}/force-delete', [ProjectController::class, 'forceDelete'])->name('projects.forceDelete');

    Route::resource('projects', ProjectController::class);
});

require __DIR__.'/auth.php';
