<x-app-layout>
    <div class="flex flex-row max-w-6xl gap-8 mx-auto p-6 bg-gray-100">
        {{-- Left Side --}}
@livewire('postslist')        
        {{-- Right Side --}}
        <div class="hidden lg:flex lg:flex-col w-1/7 pt-4">
            <div class="flex flex-row text-sm bg-blue-600 rounded p-3 mb-6">
                <div class="mr-5">
                    <a href="/{{ auth()->user()->username }}">
                        <img src="{{ auth()->user()->image }}" alt="{{ auth()->user()->username }}" class="rounded-full border border-gray-400 w-12 h-12">
                    </a>
                </div>
                <div class="flex flex-col">
                    <a href="/{{ auth()->user()->username }}" class="font-bold text-white">{{ auth()->user()->username }}</a>
                    <div class="text-sm text-blue-200">{{ auth()->user()->name }}</div>
                </div>
            </div>
            
            <div class="mt-5">
                <h3 class="text-red-600 font-bold text-lg">{{ __("Suggestions For You") }}</h3>
                <ul class="bg-gray-50 p-5 rounded-lg shadow-lg">
                    @foreach ($sug_user as $sg)
                        <li class="flex flex-col sm:flex-row my-4 text-md justify-between items-center bg-gradient-to-r from-purple-400 to-pink-400 rounded-lg p-4 shadow-lg hover:scale-105 transition-transform duration-300">
                            <div class="flex items-center w-full sm:w-auto">
                                <div class="mr-4">
                                    <a href="/{{ $sg->username }}">
                                        <div class="relative w-12 h-12">
                                            <img src="{{ $sg->image }}" class="rounded-full border-4 border-white shadow-lg absolute inset-0 w-full h-full object-cover" alt="">
                                        </div>
                                    </a>
                                </div>
                                <div class="flex flex-col">
                                    <a href="/{{ $sg->username }}" class="font-semibold text-white hover:underline">{{ $sg->username }}
                                        @if (auth()->user()->isfollowers($sg))
                                            <span class="text-xs text-yellow-300"> {{ __('متابع') }}</span>
                                        @endif
                                    </a>
                                    <div class="text-gray-200 text-sm">{{ $sg->name }}</div>
                                </div>
                            </div>
                            <div class="mt-2 sm:mt-0">
                                @livewire('follow',['user_id'=>$sg->id])
                            </div>
                        </li>
                    @endforeach
                </ul>
                @livewire('counter')
            </div>
        </div>
    </div>
</x-app-layout>