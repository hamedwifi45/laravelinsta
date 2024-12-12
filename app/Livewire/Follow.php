<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Follow extends Component
{
    public $post;
    protected $user;
    public $user_id;
    public $follow_state;
    public function mount(){
        $this->user = User::find($this->user_id);
        $this->set_follow_state();
    }
    public function togle_follow(){
        $this->user = User::find($this->user_id);
        auth()->user()->togle_follow($this->user);
        $this->set_follow_state();
    }
    protected function set_follow_state(){
        if(auth()->user()->ispending($this->user)){
            $this->follow_state = 'pending';}
        elseif(auth()->user()->isfollowing($this->user)){
            $this->follow_state = 'unfollowing';}
        else{$this->follow_state = 'follow';}
    }
    public function render()
    {
        return view('livewire.follow');
    }
}
