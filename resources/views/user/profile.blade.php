<x-app-layout>
    <div class="{{ session('success')? '' : 'hidden'}} w-50 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg absolute right-10 shadow shadow-neutral-200 " role="alert">
        <span class="font-medium">{{ session('success')}}</span>
    </div>
    <div class="grid grid-cols-4 text-black">
        {{-- {{User Image}} --}}
        <div class="px-4 col-span-1 order-1">
            <img src="{{ $user->image}}" alt="{{$user->username}} {{__('profile_picture')}}"
            class="rounded-full w-20 md:w-40 border border-neutral-200">
        </div>
        {{-- User Name and Button --}}
        <div class="px-4 col-span-2 md:ml-0 flex flex-col order-2 md:col-span-3 ">
            <div class="text-3xl mb-3">{{$user->username}}</div>
            @auth
                
            
            @if ($user->id == auth()->id())
                <a href="/{{$user->username}}/edit"
                    class="w-44 border text-sm font-bold py-1 rounded-md text-black border-neutral-300 text-center">
                    {{__('Edit Profile')}}
                </a>
            @elseif (auth()->user()->isfollowing($user))
            <a href="/{{$user->username}}/unfollow" class="w-30 bg-blue-400 text-white px-3 py-1 rounded text-center self-start">{{__("Unfollow")}}</a>

            @elseif (auth()->user()->ispending($user))
                <span class="w-30 bg-gray-400 text-white px-3 py-1 rounded text-center self-start">
                    {{__("pending")}}
                </span>
            @else
                <a href="/{{$user->username}}/follow" class="w-30 bg-blue-400 text-white px-3 py-1 rounded text-center self-start">{{__("follow")}}</a>
            @endif
            @endauth
<<<<<<< HEAD
=======
            @guest
            <div class="grid grid-row-2 w-44">
                <a href="/register"
                    class="w-22 border text-sm  font-bold py-1 rounded-md text-black border-neutral-300 text-center">
                    {{__('REFISTER')}}
                </a>
                <a href="/login"
                    class="w-22 border text-sm  font-bold py-1 rounded-md text-black border-neutral-300 text-center">
                    {{__('Login')}}
                </a>
            </div>
            @endguest
>>>>>>> 8c49fdd49b986a0b2b16dafa8d2500a7724ca479
        </div>
    {{-- User Info --}}
    <div class="text-md mt-8 px-4 col-span-3 col-start-1 order-3 md:col-start-2 md:order-4 md:mt-5">
        <p class="font-bold">{{ $user->name }}</p>
        {!! nl2br(e($user->bio)) !!}
    </div>
    <div class="col-span-4 my-5 py-2 border-y border-y-neutral-600 order-4 md:order-3 md:border-none md:px-4 md:col-start-2">
        <ul class="text-md flex flex-row justify-around md:justify-start md:space-x-10 md:text-xl">
            <li class="flex flex-col md:flex-row text-center">
                <div class="md:mr-1 font-bold md:font-normal">
                    {{$user->posts->count()}}
                </div>
                <span class="text-neutral-500 md:text-black">
                    {{$user->posts->count() > 1 ? 'posts' : "post"}}
                </span>
            </li>
            <li class="flex flex-col md:flex-row text-center">
                <div class="md:mr-1 font-bold md:font-normal">
                    {{$user->followers()->count()}}
                </div>
                <span class="text-neutral-500 md:text-black">
                    {{$user->followers()->count() > 1 ? __('followers') : __("follower") }}
                </span>
            </li>
            <li class="flex flex-col md:flex-row text-center">
                <div class="md:mr-1 font-bold md:font-normal">
                    {{$user->following()->wherePivot('confirm' , true)->get()->count()}}

                </div>
                <span class="text-neutral-500 md:text-black">
                    {{__('following ')}}
                </span>
            </li>
        </ul>
    </div>
    </div>
    {{-- Bottom --}}
    @if ($user->posts->count() > 0 and ($user->privateaccont == false or auth()->id() == $user->id or auth()->user()->isfollowing($user)))
        <div class="grid grid-cols-3 gap-1 my-5">
            @foreach ($user->posts as $posts )
                <a href="/p/{{$posts->slug}}" class="aspect-square block w-full">
                <img src="{{ asset('storage/'.$posts->image) }}" class=" object-cover w-full aspect-square" alt="{{$posts->description}}">
                </a>
            @endforeach
        </div>
        @else
        <div class="w-full text-center mt-20 text-black font-bold">
            @if ($user->privateaccont != false or auth()->id() != $user->id)
                {{__("This accont is private")}}
            @else
            {{__("ana mafe m3lom sadeg")}}
            @endif
        </div>
    @endif
</x-app-layout>