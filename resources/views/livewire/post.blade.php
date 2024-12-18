<div class="card shadow-lg rounded-lg overflow-hidden transition-transform transform hover:scale-105 w-full">
    <div class="card-head bg-gradient-to-r from-blue-500 to-purple-500 p-4 flex items-center">
        <img src="{{$post->owner->image}}" class="h-12 w-12 rounded-full border-2 border-white" alt="">
        <a href="/{{$post->owner->username}}" class="text-white font-bold text-lg ml-3 hover:underline">{{$post->owner->username}}</a>
    </div>
    
    <div class="card-body p-4">
        <div class="max-h-[35rem] overflow-hidden rounded-lg">
            <img src="{{ asset('storage/'.$post->image) }}" class="h-auto w-full object-cover rounded-lg transition-transform transform hover:scale-105" alt="">
        </div>
        <div class="mt-3 text-gray-800 font-medium text-base">
            {{$post->description}}
        </div>
        
        @livewire('like' , ['post' => $post])
        @if ($post->comnet()->count() > 0)
        <a href="/p/{{$post->slug}}" class="text-gray-500 font-bold text-sm hover:underline">{{__("view all ". $post->comnet()->count() ." comments")}}</a>
    @endif
            
        
        
        <div class="text-gray-600 text-xs mt-2">
            {{$post->created_at->diffForHumans()}}
        </div>
    </div>
    
    <div class="card-footer p-4 bg-gray-100">
        <form action="/p/{{$post->slug}}/comnite" method="post">
            @csrf
            <div class="flex items-center">
                <img src="{{auth()->user()->image}}" class="h-10 w-10 rounded-full" alt="">
                <textarea name="body" id="comnet_id" placeholder="{{__('Add Comment')}}" class="flex-grow h-10 ml-3 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition"></textarea>
                <button type="submit" class="ml-3 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">{{__('Post')}}</button>
            </div>
        </form>
    </div>
</div>