<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class likecontroller extends Controller
{
    public function __invoke(Post $post){
        return back();
    }
}
