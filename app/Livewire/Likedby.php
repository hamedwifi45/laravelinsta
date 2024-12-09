<?php

namespace App\Livewire;

use Livewire\Component;

class Likedby extends Component
{
    public $post;
    protected $listeners = ["Liketogle"=> "getLikesProperty"];
    public function getLikesProperty(){
        return $this->post->likes()->count();
    }
    public function getFirstuserProperty(){
        return $this->post->likes()->first()->username;
    }

    public function render()
    {
        return view('livewire.likedby');
    }
}
