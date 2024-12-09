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
        $ids = auth()->user()->following()->wherePivot('confirm', '=', true)->get()->pluck('id');
        $sug_user = auth()->user()->sug_user();
    
        // اجلب المنشورات الجديدة (على سبيل المثال، آخر 3 منشورات)
        $newPosts = Post::whereIn('user_id', $ids)->orderBy('created_at', 'desc')->take(7)->inRandomOrder()->get();
    
        // اجلب بقية المنشورات بشكل عشوائي
        $otherPosts = Post::whereIn('user_id', $ids)->whereNotIn('id', $newPosts->pluck('id'))->inRandomOrder()->get();
    
        // دمج المنشورات الجديدة مع المنشورات العشوائية
        $posts = $newPosts->merge($otherPosts);
    
        return view('posts.index', compact(['posts', 'sug_user']));
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
        
        if($request->has('image')){
            $images = $request['image']->store('posts' , 'public');
            $data['image'] = $images;
            }
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
        $this->authorize('update' , $post);
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
        $this->authorize('delete', $post);
        Storage::delete($post->image);
        $post->delete();
        return redirect(url('home'));
    }
    public function explore(){
        $posts = Post::whereRelation('owner' , 'privateaccont' , '=' , '0')->whereNot('user_id' , auth()->id())->simplePaginate(9);
        return view('posts.explore' , compact('posts'));
    }

}
