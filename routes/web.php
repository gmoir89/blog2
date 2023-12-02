<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;

Route::get('/', [BlogController::class, 'index']);
Route::get('blogs/create', [BlogController::class, 'create'])->name('blogs.create'); // Move this line up
Route::resource('blogs', BlogController::class)->except(['show']);

Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');
Route::get('/blogs/test', [BlogController::class, 'test']);

// New route for storing comments
Route::post('blogs/{blog}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('comments', CommentController::class)->only(['store']);

require __DIR__.'/auth.php';