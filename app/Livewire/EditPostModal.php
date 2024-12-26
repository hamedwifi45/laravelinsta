<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;
use App\Models\Post;
class EditPostModal extends ModalComponent
{
    public Post $post;
    public $description ;
    public function mount(Post $post)
    {
        $this->post = $post ;
        $this->description = $post->description;
    }
    public function update()
    {
        $this->validate([
            'description' => 'required'
        ]);

        $this->post->update([
            'description' => $this->description
        ]);

        return redirect()->route('show' , ['post' => $this->post->slug]);

    }
    public static function modalMaxWidth(): string
    {
        return '7xl';
    }
    public function render()
    {
        return view('livewire.edit-post-modal');
    }
}
