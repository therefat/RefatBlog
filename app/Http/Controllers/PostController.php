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
        $bodys = $validated['body'];

//       // image uploads
libxml_use_internal_errors(true); // Suppress HTML errors
//
$dom = new \DOMDocument();

$dom->loadHTML(mb_convert_encoding($bodys, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

$images = $dom->getElementsByTagName('img');

foreach ($images as $key => $img) {
    $src = $img->getAttribute('src');


    if (preg_match('/^data:image\/(\w+);base64,/', $src)) {

        $data = base64_decode(preg_replace('/^data:image\/\w+;base64,/', '', $src));


        $image_name = "/storage/" . time() . $key . '.png';


        file_put_contents(public_path() . $image_name, $data);


        $img->setAttribute('src', $image_name);
    }
}


$validated['body'] = $dom->saveHTML();


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
        $bodys = $validated['body'];

        // Find the post to update
        $oldImages = [];
        $newImages = [];
        $oldDom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $oldDom->loadHTML($post->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $oldImagesTags = $oldDom->getElementsByTagName('img');

        foreach ($oldImagesTags as $img) {
            $oldImages[] = $img->getAttribute('src'); // Collect all existing image paths
        }


        libxml_use_internal_errors(true);


        $dom = new \DOMDocument();
        $dom->loadHTML(mb_convert_encoding($bodys, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        // Get all the images in the body
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            $src = $img->getAttribute('src');


            if (preg_match('/^data:image\/(\w+);base64,/', $src)) {
                   $data = base64_decode(preg_replace('/^data:image\/\w+;base64,/', '', $src));


                $image_name = "/storage/" . time() . $key . '.png';


                file_put_contents(public_path() . $image_name, $data);


                $img->setAttribute('src', $image_name);
                $newImages[] = $image_name;
            }else {

                $newImages[] = $src;
            }
        }

        $validated['body'] = $dom->saveHTML();

        $post->updateOrFail($validated);
        // Delete old images that are no longer in use
        foreach ($oldImages as $oldImage) {
            if (!in_array($oldImage, $newImages) && file_exists(public_path() . $oldImage)) {

                unlink(public_path() . $oldImage); // Delete the old image from storage
            }
        }
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
