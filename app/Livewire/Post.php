<?php

namespace App\Livewire;

use Livewire\Component;

class Post extends Component
{
    public $post;
    public function getCommiteProperty(){

    }
    public function render()
    {
        return view('livewire.post');
    }
}
