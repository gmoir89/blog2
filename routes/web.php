<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;

// Add this line for creating a new blog post


Route::get('/', [BlogController::class, 'index']);
Route::resource('blogs', BlogController::class)->except(['show']); // Remove 'create' from the 'except' array

Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');

Route::get('test', function(){
});

Route::get('blogs/create', function(){
    return view('blogs.create');

}); // Add this line for creating a new blog post
Route::get('/blogs/test', [BlogController::class, 'test']); 

// New route for storing comments
Route::post('blogs/{blog}/comments', [CommentController::class, 'store'])
    ->name('comments.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});



require __DIR__.'/auth.php';


