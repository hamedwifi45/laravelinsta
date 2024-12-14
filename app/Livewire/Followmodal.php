<?php

namespace App\Livewire;

use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class Followmodal extends ModalComponent
{
    protected $user;
    public $user_id;
    
    public function getFollowingListProperty(){
        $this->user = User::find($this->user_id);
        return $this->user->following()->wherePivot('confirm' , true)->get();
    }
    public function unfollow($user_id){
        $following_user = User::find($user_id);
        $this->user = User::find($this->user_id);
        $this->user->unfollow($following_user);
        $this->dispatch('unfollowingUser');
    }
    public function render()
    {
        return view('livewire.followmodal');
    }
}
