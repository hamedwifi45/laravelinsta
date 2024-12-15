<div class="max-h-96 flex flex-col">
    <div class="flex w-full items-center border-b-neutral-100 p-2">
        <h1 class="p-3 ml-2 border-spacing-5 text-center caret-lime-500">متلوصض الدنيا يسطا</h1>
        <button wire:click="$dispatch('closeModal')">اغلق صفة يا ابني</button>
    </div>
    <ul class="overflow-y-auto">
        @forelse ($this->following_list as $follow)
        <li class="flex flex-row w-full p-3 items-center text-sm">
            <div >
                <img src="{{ asset($follow->image) }}" class="h-8 w-8 mr-2 rounded-full border border-neutral-300" alt="{{$follow->username}}" >
            </div>
            <div class="flex flex-col grow">
                <div class="font-bold">
                    <a href="/{{$follow->username}}">{{$follow->username}}</a>
                </div>
                <div class="text-sm text-neutral-500">
                    {{$follow->name}}
                </div>
            </div>
            @auth
                @if ($follow->isfollowers())
                    <div >
                        <button wire:click='unfollow({{$follow->id}})' class="border border-gray-500 px-2 py-1 rounded">{{__('unfollow')}}</button>
                    </div>
                @elseif (!($follow->isfollowers()))
                    <div >
                        <button wire:click='follow({{$follow->id}})' class="border border-gray-500 px-2 py-1 rounded">{{__('follow')}}</button>
                    </div>
                @endif
                
            @endauth
        </li>
            
        @empty
            <li class="w-full p-3 text-center">
                {{__("You are not following anyone")}}
            </li>
        @endforelse
    </ul>
</div>
