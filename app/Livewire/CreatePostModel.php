<?php

namespace App\Livewire;
use LivewireUI\Modal\ModalComponent;
use Livewire\WithFileUploads;
class CreatePostModel extends ModalComponent
{
    use WithFileUploads;
    public $image;

    public static function modalMaxWidth(): string
{
    return '3xl';
}
    public function imagetemp(){
        $image = $this->image->store('temp');
        $this->dispatch('openModal' ,  component: 'image-filter', arguments:  (image: {{ $image }}) );
    }
    public function render()
    {
        return view('livewire.create-post-model');
    }
}
