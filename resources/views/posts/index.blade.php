<x-app-layout>
    <div class="flex flex-row max-w-6xl gap-8 mx-auto p-6 bg-gray-100">
        {{-- Left Side --}}
        <div class="w-full lg:w-2/3">
            @forelse ($posts as $post)
                <x-post :post="$post" class="mb-6 shadow-lg rounded-lg bg-white p-4 transition-transform transform hover:scale-105"/>
            @empty
                <div class="max-w-2xl mx-auto text-center p-4 bg-white rounded-lg shadow">
                    <p class="text-gray-600">{{ __("start following your friend and enjoy") }}</p>
                </div>
            @endforelse
        </div>
        
        {{-- Right Side --}}
        <div class="hidden lg:flex lg:flex-col w-1/3 pt-4">
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
                <ul>
                    @foreach ($sug_user as $sg)
                        <li class="flex flex-row my-5 text-sm justify-between items-center bg-sky-100 rounded p-3 shadow hover:bg-sky-200 transition">
                            <div class="flex items-center">
                                <div class="mr-3">
                                    <a href="/{{ $sg->username }}">
                                        <img src="{{ $sg->image }}" class="rounded-full border border-black w-10 h-10" alt="">
                                    </a>
                                </div>
                                <div class="flex flex-col">
                                    <a href="/{{ $sg->username }}" class="font-bold text-blue-800">{{ $sg->username }}
                                        @if (auth()->user()->isfollowers($sg))
                                            <span class="text-xs text-gray-500"> {{ __('Follower') }}</span>
                                        @endif
                                    </a>
                                    <div class="text-gray-700 text-sm">{{ $sg->name }}</div>
                                </div>
                            </div>
                            <div>
                                @if (auth()->user()->ispending($sg))
                                    <span class="text-gray-600 text-xs font-bold">{{ __('Pending') }}</span>
                                @else
                                    <a href="/{{ $sg->username }}/follow" class="text-red-500 font-bold">{{ __("Follow") }}</a>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
                @livewire('counter')
            </div>
        </div>
    </div>
</x-app-layout>