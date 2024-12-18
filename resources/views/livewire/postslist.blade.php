<div>
    <div class="w-full ">
        @forelse ($this->posts as $post)
            @livewire('post' , ['post' => $post ], key($post->id))
        @empty
            <div class="max-w-2xl mx-auto text-center p-4 bg-white rounded-lg shadow">
                <p class="text-gray-600">{{ __("start following your friend and enjoy") }}</p>
            </div>
        @endforelse
    </div>
</div>
