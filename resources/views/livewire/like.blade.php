<div class="flex items-start justify-start mt-3 ">
    <a wire:click='toggle' class="text-red-600 text-2xl hover:scale-110 transition-transform">
        <i class="bi bi-heart{{$post->liked(auth()->user())? "-fill" : ''}}"></i>
    </a>
    <a href="/p/{{$post->slug}}" class="text-gray-600 text-2xl hover:scale-110 transition-transform mx-3">
        <i class="bi bi-chat-left-text{{$post->liked(auth()->user())? "-fill" : ''}}"></i>
    </a>
    
    
</div>