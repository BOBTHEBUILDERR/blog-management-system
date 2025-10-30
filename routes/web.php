<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/posts/create', [PostsController::class, 'create'])->name('posts.create');
    // Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
    // Route::get('/posts/{post}', [PostsController::class, 'show'])->name('posts.show');
    // Route::get('/posts/{post}/edit', [PostsController::class, 'edit'])->name('posts.edit');
    // Route::put('/posts/{post}', [PostsController::class, 'update'])->name('posts.update');
    // Route::delete('/posts/{post}', [PostsController::class, 'destroy'])->name('posts.destroy');

    Route::resource('posts', PostsController::class);
// Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');


    // Highlighted posts
    Route::get('/highlight', [PostsController::class, 'highlight'])->name('posts.highlight');

    // Comments
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');


});



require __DIR__.'/auth.php';
