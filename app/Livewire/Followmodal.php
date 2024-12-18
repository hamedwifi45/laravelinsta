<?php

namespace App\Livewire;

use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class Followmodal extends ModalComponent
{
    protected $user;
    public $user_id;
    
    protected $userh;


    
    public function getFollowingListProperty(){
        $this->user = User::find($this->user_id);
        $this->userh = auth()->user();
        return $this->user->following()->wherePivot('confirm' , true)->get();
    }
    public function getUserhProperty(){
        return auth()->user();
    }
    public function unfollow($user_id){
        $this->user = auth()->user();
        $following_user = User::find($user_id);
        // $this->user = User::find($this->user_id);
        $this->user->unfollow($following_user);
        $this->dispatch('unfollowingUser');
    }
    public function follow($user_id){
        $this->user = auth()->user();
        $following_user = User::find($user_id);
        // $this->user = User::find($this->user_id);
        $this->user->follow($following_user);
        $this->dispatch('followingUser');
    }
    public function render()
    {
        return view('livewire.followmodal');
    }
}
