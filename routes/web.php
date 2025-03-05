<?php

use Illuminate\Http\Request;
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

Route::post('posts/search', fn (Request $request) => redirect('posts/search/' . $request->get('search')))->name('posts.search');
Route::get('posts/search/{search}', [PostController::class, 'search'])->where('search', '.*');

require __DIR__ . '/auth.php';
