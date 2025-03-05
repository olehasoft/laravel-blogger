<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\PostResource;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

Route::post('login', function (Request $request) {
    /** @var User $user */
    $user = User::firstOrFail();
    $token = $user->createToken($request->token_name ?? 'auth');

    return ['token' => $token->plainTextToken];
});

Route::get('/posts', function () {
    return PostResource::collection(Post::paginate(5));
});

Route::get('/posts/{id}', function (string $id) {
    return new PostResource(Post::findOrFail($id));
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('posts/{id}/comments', function (Request $request, string $id) {
        $request->validate([
            'content' => 'required|max:1000',
        ]);

        /** @var Post $post */
        $post = Post::findOrFail($id);

        /** @var Comment $comment */
        $comment = Comment::create([
            'post_id' => $post->id,
        ] + $request->all());

        return ['success' => true, 'data' => $comment];
    });
});
