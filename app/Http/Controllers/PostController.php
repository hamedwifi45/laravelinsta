<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sug_user = auth()->user()->sug_user() ;
        $posts = Post::all();
        return view('posts.index' , compact(['posts','sug_user']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'required',
            'image' => ['mimes:jpg,png,gif,jpeg']
        ]
        );
        
        
        $images = $request['image']->store('posts' , 'public');
        $data['image'] = $images;
        $data['slug'] = Str::random(10);
        auth()->user()->posts()->create($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show' , compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit' , compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'description' => 'required',
            'image' => ['nullable','mimes:jpg,png,gif,jpeg']
        ]
        );
        if($request->has("image")){
            $image = $request["image"]->store('posts' , "public");
            $data["image"] = $image;
        };
        $post->update($data);
        return redirect('/p/'.$post->slug);
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Storage::delete("public/" . $post->image);
        $post->delete();
        return redirect(url('home'));
    }
    public function explore(){
        $posts = Post::whereRelation('owner' , 'privateaccont' , '=' , '0')->whereNot('user_id' , auth()->id())->simplePaginate(9);
        return view('posts.explore' , compact('posts'));
    }
}
