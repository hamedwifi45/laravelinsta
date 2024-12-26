<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;
use Intervention\Image\Laravel\Facades\Image;

class ImageFilter extends ModalComponent
{

    protected $listeners = ['add_temp_image' => 'add_temp' , 'modalClosed' => 'delete_temp'];
    public $image;
    public $temp = [];
    public $filters = ['Original', 'Clarendon', 'Gingham', 'Moon', 'Perpetua'];
    public $filtered_image;
    public $description;

    public function mount($image){
        $this->image = $image;
        $this->filtered_image = $this->image;
        $this->add_temp($this->image);

    }

    public function filter_original(){
        $this->filtered_image = $this->image;
    }
    public function filter_clarendon(){
        $filter_image_name = Str::random(20). '.jpeg';
        $img = Image::read(storage_path('app/public'). DIRECTORY_SEPARATOR.$this->image)->brightness(20)
        ->contrast(15)
        ->save(storage_path('app/public/temp'). DIRECTORY_SEPARATOR . $filter_image_name);
        $this->filtered_image = 'temp' . DIRECTORY_SEPARATOR . $filter_image_name;
        $this->dispatch('add_temp_image', $this->filtered_image);

    }
    public function filter_moon()
    {
        $filter_image_name = Str::random(20). '.jpeg';
        $img = Image::read(storage_path('app/public') . DIRECTORY_SEPARATOR . $this->image)
            ->brightness(10)
            ->contrast(5)
            ->greyscale()
            ->save(storage_path('app/public/temp') . DIRECTORY_SEPARATOR . $filter_image_name);
        $this->filtered_image = 'temp' . DIRECTORY_SEPARATOR . $filter_image_name;
        $this->dispatch('add_temp_image', $this->filtered_image);
    }

    public function filter_gingham()
    {
        $filter_image_name = Str::random(20). '.jpeg';
        $img = Image::read(storage_path('app/public') . DIRECTORY_SEPARATOR . $this->image)
            ->brightness(20)
            ->contrast(20)
            ->colorize(0, -10, -10)
            ->save(storage_path('app/public/temp') . DIRECTORY_SEPARATOR . $filter_image_name);
        $this->filtered_image = 'temp' . DIRECTORY_SEPARATOR . $filter_image_name;
        $this->dispatch('add_temp_image', $this->filtered_image);
    }

    public function filter_perpetua()
    {
        $filter_image_name = Str::random(20). '.jpeg';
        $img = Image::read(storage_path('app/public') . DIRECTORY_SEPARATOR . $this->image)
            ->contrast(-10)
            ->colorize(-30, 10, 10)
            ->save(storage_path('app/public/temp') . DIRECTORY_SEPARATOR . $filter_image_name);
        $this->filtered_image = 'temp' . DIRECTORY_SEPARATOR . $filter_image_name;
        $this->dispatch('add_temp_image', $this->filtered_image);
    }
    public function add_temp($image)
    {
        $this->temp[] = $image;
    }
    public function publish()
    {
        $this->validate([
            "description" => 'required'
        ]);
        $post_image = 'posts/' . Str::random(20) . '.jpeg';
        Storage::move($this->filtered_image , $post_image);
        $post = auth()->user()->posts()->create([
            'description' => $this->description,
            'slug' => Str::random(10),
            'image' => $post_image
        ]);
        $this->forceClose()->closeModal();
    }
    public static function dispatchCloseEvent(): bool
    {
        return true;
    }
    public function delete_temp()
    {
        Storage::delete($this->temp);
    }
    public static function modalMaxWidth(): string
    {
        return '5xl';
    }
    public function render()
    {
        return view('livewire.image-filter');
    }
}
