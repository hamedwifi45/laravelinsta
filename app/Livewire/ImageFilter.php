<?php

namespace App\Livewire;

use Intervention\Image\Laravel\Facades
use LivewireUI\Modal\ModalComponent;


class ImageFilter extends ModalComponent
{
    public $image;
    public $filters = ['Original', 'Clarendon', 'Gingham', 'Moon', 'Perpetua'];
    public $filtered_image;
    public function mount($image){
        $this->image = $image;
        $this->filtered_image = $this->image;
    }
    public function filter_original(){
        $this->filtered_image = $this->image;
    }
    public function filter_clarendon(){
        $img = Image::make(storage_path('app/public'). DIRECTORY_SEPARATOR.$this->image);


    }
    public function render()
    {
        return view('livewire.image-filter');
    }
}
