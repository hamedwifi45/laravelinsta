<div class="card">
    <!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
    <div class="card-head border-gray-300 border-b">
        <br>
    <img src="{{$post->owner->image}}" class="h-9 w-9 mr-3 rounded-full" alt="" srcset="">
    <a href="/{{$post->owner->username}}" class=" font-bold">{{$post->owner->username}}</a>
    <br>
    </div>
    <br>
    <div class="card-body">
        <br>
        <div class="max-h-[35rem] overflow-hidden">
            {{--  --}}
            <img src="{{ asset('storage/'.$post->image) }}" class="h-auto w-full object-cover" alt="{{-- {{$post->description}} --}}">
        </div>
        <div class="p-2 mt-3 font-medium">
            {{$post->description}}
        </div>
        <div class="p-3">
            <a href="/p/{{$post->slug}}/like" class="block">
                <i class="bi bi-heart{{$post->liked(auth()->user())? "-fill text-red-600" : ''}} text-2xl font-bold hover:text-blue-700 hover:shadow-lg hover:shadow-blue-800 transition-all ease-out mr-3"></i>
            </a>
        </div>
        @if ($post->comnet()->count() > 0)
            <a href="/p/{{$post->slug}}" class="p-3 font-bold text-sm text-gray-500">{{__("view all". $post->comnet()->count()."comnet")}}</a>
        @endif
        
        <div class="p-3 text-gray-600 uppercase text-xs">
            {{$post->created_at->diffForHumans()}}
        </div>

    </div>
    <div class="card-footer">

        <form action="/p/{{$post->slug}}/comnite" method="post" >
            @csrf
            <div class="flex flex-row items-center">
                <img src="{{auth()->user()->image}}" class="h-100 mx-5 w-10 rounded-full" alt="" srcset="">
                <textarea name="body" id="comnet_id" placeholder="{{__('add Commite')}}" class="h-8 grow resize-none overflow-hidden border-none rounded-l  bg-gray-200 p-1 outline-0 focus:ring-0"></textarea>
                <button type="submit" class=" border-none bg-gray-700 px-2 py-1 font-bold text-blue-700 rounded-r  mr-3  ">{{__('Post')}}</button>
            </div>
        </form>
    </div>
</div>