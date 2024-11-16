<x-app-layout>
    <div class="flex flex-row max-w-3xl gap-8 mx-auto">
        {{-- Left Side --}}
        <div class="w-[30rem] mx-auto lg:w-[95rem]">
            @forelse ($posts as $post )
            <x-post :post="$post"/>    
            @empty
                <div class="max-w-2xl gap-8 mx-auto">
                    __("start followin your friend and enjoy")
                </div>
            @endforelse
            
        </div>
        {{-- Right Side --}}
        <div class="hidden w-[60rem] lg:flex lg:flex-col  pt-4">
            <div class="flex flex-row text-sm bg-gray-600 rounded p-3">
                <div class="mr-5">
                    <a href="/{{auth()->user()->username}}">
                    <img src="{{auth()->user()->image}}" alt="{{auth()->user()->username}}" class="rounded-full border border-gray-600 w-12 h-12" srcset="">
                    </a>
                </div>
                <div class="flex flex-col">
                    <a href="/{{auth()->user()->username}}" class="font-bold text-white">{{auth()->user()->username}}</a>
                    <div class="text-sm text-blue-400 ">{{auth()->user()->name}}</div>
                </div>
                
            </div>
            <div class="mt-5">
                <h3 class="text-gray-500 font-bold">{{__("suggest For You")}}</h3>
                <ul>
                    @foreach ($sug_user as $sg )
                        <li class="flex flex-row my-5 text-sm justify-items-center  bg-gray-600 rounded p-3" >
                            <div class="mr-5">
                                <a href="/{{$sg->username}}">
                                <img src="{{$sg->image}}" class="rounded-full border border-black w-9 h-9" alt="">
                                </a>
                            </div>
                            <div class="flex flex-col grow">
                                <a href="/{{$sg->username}}" class="font-bold">{{$sg->username}}</a>
                                <div class="text-gray-200 text-sm">{{$sg->name}}</div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        
    </div>
</x-app-layout>