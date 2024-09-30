<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Container\Attributes\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.post.index',[
            'posts' => Post::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.post.create',[
            'categories' => Category::latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] = str($validated['title'])->slug();
        $post = \Illuminate\Support\Facades\Auth::user()->posts()->create($validated);
        if($post){
            return redirect()->route('admin.post.index')->with('success','Post created successfully');
        }
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::latest()->get();
        return view('admin.post.edit',compact('post','categories'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $validated = $request->validated();
        if($validated['title'] !== $post->title){
            $validated['slug'] = str($validated['title'])->slug();
        }
        $post->updateOrFail($validated);
        return redirect()->route('admin.post.index')->with('success','Post updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->deleteOrFail();
        return redirect()->route('admin.post.index')->with('success','Post deleted successfully');

    }
}
