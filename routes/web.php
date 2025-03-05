<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return redirect()->route('posts.index');
});

Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class)->except(['index', 'show']);
    Route::post('posts/{post}/comments', [PostController::class, 'comment'])->name('posts.comment');
});

Route::resource('posts', PostController::class)->only(['index', 'show']);

require __DIR__ . '/auth.php';
