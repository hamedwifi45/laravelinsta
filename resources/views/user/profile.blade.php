<x-app-layout>
    <div class="{{ session('success')? '' : 'hidden'}} w-50 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg absolute right-10 shadow-lg" role="alert">
        <span class="font-medium">{{ session('success')}}</span>
    </div>
    <div class="grid grid-cols-4 text-black bg-gradient-to-r from-blue-500 to-blue-300 p-6 rounded-lg shadow-lg">
        {{-- {{User   Image}} --}}
        <div class="px-4 col-span-1 order-1">
            <img src="{{ $user->image}}" alt="{{$user->username}} {{__('profile_picture')}}"
            class="rounded-full w-20 md:w-40 border-4 border-white shadow-lg transition-transform duration-300 hover:scale-110 hover:shadow-xl">
        </div>
        {{-- User Name and Button --}}
        <div class="px-4 col-span-2 md:ml-0 flex flex-col order-2 md:col-span-3 ">
            <div class="flex items-center">
                <div class="text-3xl mb-3 text-white hover:text-yellow-300 transition-colors duration-300 font-bold">{{$user->username}}</div>

                @auth
                    @if ($user->id == auth()->id())
                        <a href="/{{$user->username}}/edit"
                            class="w-44 border-2 border-white text-sm font-bold py-1 rounded-md text-white text-center transition-colors duration-300 hover:bg-yellow-300 hover:text-black ml-4">
                            {{__('Edit Profile')}}
                        </a>
                    @endif

                    <!-- زر المتابعة -->
                    @if(auth()->id() != $user->id)
                    <div class="mx-3 flex items-center">
                        <button  class="follow-button inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-bold rounded-md text-black bg-yellow-400 hover:bg-yellow-500 transition duration-300 ease-in-out transform hover:scale-105 shadow-lg">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            @livewire('Follow', ['user_id' => $user->id])
                        </button>
                    </div>
                    @endif
                @endauth

                @guest
                <div class="grid grid-row-2 w-44">
                    <a href="/register"
                        class="w-22 border-2 border-white text-sm font-bold py-1 rounded-md text-white text-center transition-colors duration-300 hover:bg-yellow-300 hover:text-black">
                        {{__('Register')}}
                    </a>
                    <a href="/login"
                        class="w-22 border-2 border-white text-sm font-bold py-1 rounded-md text-white text-center transition-colors duration-300 hover:bg-yellow-300 hover:text-black">
                        {{__('Login')}}
                    </a>
                </div>
                @endguest
            </div>
        </div>
    {{-- User Info --}}
    <div class="text-md mt-8 px-4 col-span-3 col-start-1 order-3 md:col-start-2 md:order-4 md:mt-5">
        <p class="font-bold text-white text-lg">{{ $user->name }}</p>
        <p class="text-white">{{ nl2br(e($user->bio)) }}</p>
    </div>
    <div class="col-span-4 my-5 py-2 border-y border-white order-4 md:order-3 md:border-none md:px-4 md:col-start-2">
        <ul class="text-md flex flex-row justify-around md:justify-start md:space-x-10 md:text-xl text-white">
            <li class="flex flex-col md:flex-row text-center">
                <div class="md:mr-1 font-bold md:font-normal">
                    {{$user->posts->count()}}
                </div>
                <span>
                    {{$user->posts->count() > 1 ? __('posts') : __("post")}}
                </span>
            </li>
            <li class="flex flex-col md:flex-row text-center">
                <div class="md:mr-1 font-bold md:font-normal">
                    {{$user->followers()->count()}}
                </div>
                <span>
                    {{$user->followers()->count() > 1 ? __('followers') : __("follower") }}
                </span>
            </li>
            @livewire('hollowing', ['userId' => $user->id])
        </ul>
    </div>
    </div>
    {{-- Bottom --}}
    @if ($user->posts->count() > 0 and ($user->privateaccont == false or auth()->id() == $user->id or auth()->user()->isfollowing($user)))
        <div class="grid grid-cols-3 gap-1 my-5">
            @foreach ($user->posts as $posts )
                <a href="/p/{{$posts->slug }}" class="aspect-square block w-full transition-transform duration-300 hover:scale-105 hover:shadow-lg">
                    <img src="{{ asset('storage/'.$posts->image) }}" class="object-cover w-full aspect-square rounded-lg shadow-md" alt="{{$posts->description}}">
                </a>
            @endforeach
        </div>
    @else
        <div class="w-full text-center mt-20 text-black font-bold">
            @if ($user->privateaccont != false or auth()->id() != $user->id)
                {{__("This account is private")}}
            @else
                {{__("لا توجد معلومات متاحة")}}
            @endif
        </div>
    @endif
</x-app-layout>
