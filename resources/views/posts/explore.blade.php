<x-app-layout>
    <div class="grid grid-cols-3 gap-2 md:gap-5 mt-8">
        @foreach ($posts as $post )
        <div>
            <a href="/p/{{$post->slug}}">
            <img src="{{ asset('storage/'.$post->image) }}" class="w-full aspect-square object-cover" alt=""></a>
        </div>
            
        @endforeach

    </div>
    <div class="mt-5">
        {{$posts->links()}}
    </div>
</x-app-layout>