<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $message = "hra";
    public function render()
    {
        return view('livewire.counter');
    }
}
