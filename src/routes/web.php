<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\TimelineController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TmdbController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileEditController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('works', WorkController::class);

    Route::get('/timeline', [TimelineController::class, 'index'])->name('timeline.index');
    
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

    Route::post('/users/{user}/follow', [FollowController::class, 'store'])->name('follows.store');
    Route::delete('/users/{user}/follow', [FollowController::class, 'destroy'])->name('follows.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/tmdb/search', [TmdbController::class, 'search'])->name('tmdb.search');
    Route::get('/books/search', [BookController::class, 'search'])->name('books.search');

    Route::get('/profile-edit', [ProfileEditController::class, 'edit'])->name('profile.edit.custom');
    Route::put('/profile-edit', [ProfileEditController::class, 'update'])->name('profile.update.custom');
    });

require __DIR__.'/auth.php';
