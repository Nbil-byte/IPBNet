<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\CommentController;
use App\Http\Middleware\ClearStorage;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [PostController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::post('/posts/{id}/like', [PostController::class, 'like'])->name('posts.like')->middleware('not_liked');
    Route::post('/posts/{id}/unlike', [PostController::class, 'unlike'])->name('posts.unlike');
    Route::get('/posts/{id}', [PostController::class, 'singlepost'])->name('posts.singlepost');
    Route::patch('/news/{id}/update-status', [PostController::class, 'updateStatus'])->name('news.updateStatus');
});



Route::middleware('auth')->group(function () {
    Route::post('/follow/{id}', [FollowController::class, 'follow'])->name('follow');
    Route::delete('/unfollow/{id}', [FollowController::class, 'unfollow'])->name('unfollow');
    Route::post('/posts/{postId}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/posts/{postId}/comments', [CommentController::class, 'destroy'])->name('comments.destroy');
});






require __DIR__.'/auth.php';
