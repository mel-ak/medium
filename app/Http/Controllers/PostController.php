<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\PostCreateRequest;

use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $posts = Post::orderBy('created_at', 'DESC')->simplePaginate(5);
        return view('post.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('post.create', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        $data = $request->validated();

        $image = $data['image'];

        $data['user_id'] = auth()->user()->id;
        $data['slug'] = Str::slug($data['title']);

        $data['image'] = $image->store('posts', 'public');

        Post::create($data);

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show($username, Post $post)
    {
        // $post->load('user', 'category');
        return view('post.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
