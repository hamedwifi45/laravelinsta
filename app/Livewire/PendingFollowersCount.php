<?php

namespace App\Livewire;

use Livewire\Component;

class PendingFollowersCount extends Component
{
    protected $listeners = ['toglefollow' => '$refresh' , 'confirmuser' => '$refresh' , 'confirmdelete' => '$refresh'];
    
    public function getCountProperty(){
        return auth()->user()->pending_followers()->count();
    }
    public function render()
    {
        return view('livewire.pending-followers-count');
    }
}
