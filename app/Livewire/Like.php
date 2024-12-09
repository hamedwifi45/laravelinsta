<?php

namespace App\Livewire;

use Livewire\Component;

class Like extends Component
{
    public $post;
    public function toggle(){
        auth()->user()->likes()->toggle(ids: $this->post);
        $this->dispatch("Liketogle");
    }
    public function render()
    {
        return view('livewire.like');
        
    }
}
