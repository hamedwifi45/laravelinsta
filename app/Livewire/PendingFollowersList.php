<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class PendingFollowersList extends Component
{
    protected $listeners = ['toglefollow' => '$refresh' , 'confirmuser' => '$refresh' , 'confirmdelete' => '$refresh'];
    

    protected $follower ;
    public function confirm($id){
        $this->follower = User::find($id);
        auth()->user()->confirm($this->follower);
        $this->dispatch("confirmuser");
    }
    public function delete($id){
        $this->follower = User::find($id);
        auth()->user()->deletefollowerRequset($this->follower);
        $this->dispatch("confirmdelete");

    }

    public function render()
    {
        return view('livewire.pending-followers-list');
    }
}
