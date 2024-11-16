<x-app-layout>
    <div class="h-screen md:flex md:flex-row">
        {{-- Left --}}
        <div class="h-full md:w-7/12 bg-black flex items-center">
            <img src="{{ asset('storage/'.$post->image) }}" alt="{{$post->description}}" class="max-h-screen object-cover mx-auto">
        </div>


        

        {{-- Right --}} 
        <div class="flex w-full flex-col bg-white md:w-5/12">
        {{-- Top --}}
        <div class="border-b-2">
            <div class="flex item-center p-5">
                <img src="{{  $post->owner->image }}" alt="{{$post->owner->username}}" class="mr-5 h-10 w-10 rounded-full">
                <div class="grow">
                <a href="/{{$post->owner->username}}" class=" font-bold">{{$post->owner->username}}</a>
            </div>
            
                @if ($post->owner->id == auth()->user()->id)
                <a href="/p/{{$post->slug}}/edit" class="rounded-full   text-blue-500"><i class="bi bi-pencil-square font-bold  text-xl "></i></a>
                <form action="/p/{{$post->slug}}/Delete" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('are you sure?')">
                        <i class="bi bi-file-x-fill text-2xl text-red-600 ml-2 rounded-full  "></i>
                    </button>
                    </form>
                
                @endif
                
                
            </div>
        </div>
        {{-- Midlle --}}
        <div class="grow overflow-y-auto">
            <div class="flex items-start p-5">
                <img src="{{$post->owner->image}}" class="mr-5 h-10 w-10 rounded-full">
                <div class="">
                    <a href="/{{$post->owner->username}}" class=" block font-bold">{{$post->owner->username}}</a>
                    {{$post->description}}
                </div>

            </div>
            {{-- Comment --}}
            <div>
                @foreach ($post->comnet as $commite )
                    <div class="flex items-start px-5 py-2">
                        <img src="{{$commite->owner->image}}" class="h-100 mr-5 w-10 rounded-full" alt="">
                        <div class="flex flex-col">
                            <div class="">
                                <a href="/{{$commite->owner->username}}" class="font-bold block">{{$commite->owner->username}}</a>
                                {{$commite->body}}
                            </div>
                            <div class="mt-1 text-sm font-bold text-gray-400">
                                {{$commite->created_at->diffForHumans(null,true,true)}}
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="border-t-2 grow overflow-">
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




        </div>


    </div>




</x-app-layout>