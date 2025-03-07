<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;

class PostController extends Controller
{
    /**
     * Display a list of search results.
     */
    public function search(string $search)
    {
        $search = trim($search);

        if (strlen($search) === 0) {
            return redirect()->route('posts.index');
        }

        $like = '%' . preg_replace('/\s+/u', '%', $search) . '%';
        $posts = Post::where('title', 'like', $like)->with('category')->orderByDesc('id')->simplePaginate(5);

        return view('posts.index', compact('posts', 'search'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category')->orderByDesc('id')->simplePaginate(5);

        return view('posts.index', compact('posts'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $comments = $post->comments->reverse();

        return view('posts.show', compact('post', 'comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:250',
            'content' => 'required|max:16380',
            'category_id' => 'required|exists:categories,id'
        ]);

        Post::create($request->all());

        return redirect()->route('posts.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();

        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:250',
            'content' => 'required|max:16380',
            'category_id' => 'required|exists:categories,id'
        ]);

        $post->update($request->all());

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index');
    }

    /**
     * Store a newly created post comment in storage.
     */
    public function comment(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|max:1000',
        ]);

        Comment::create([
            'post_id' => $post->id,
        ] + $request->all());

        return redirect()->route('posts.show', $post);
    }
}
