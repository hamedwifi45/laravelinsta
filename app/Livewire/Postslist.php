<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class Postslist extends Component
{
    protected $listeners = ["toglefollow"=> '$refresh'];
    public function getPostsProperty(){
        $ids = auth()->user()->following()->wherePivot('confirm' , true)->get()->pluck('id');
        return Post::whereIn('user_id', $ids)->latest()->get();
    }
    public function render()
    {
        return view('livewire.postslist');
    }
}
