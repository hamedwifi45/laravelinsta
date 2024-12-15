<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Hollowing extends Component
{
    public $userId;
    protected $user;
    protected $listeners = ["unfollowingUser"=> 'getCountProperty',
"followingUser" => 'getCountProperty'];

    public function getCountProperty(){
        $this->user = User::find($this->userId);
        return $this->user->following()->wherePivot('confirm' , true)->count();
    }
    public function render()
    {
        return view('livewire.hollowing');
    }
}
