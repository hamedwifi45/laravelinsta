<div class="p-2">
    <ul>
    @forelse (auth()->user()->pending_followers as $pending)
    <li class="flex flex-row w-full p-3 items-center text-sm">
        <div >
            <img src="{{ asset($pending->image) }}" class="h-8 w-8 mr-2 rounded-full border border-neutral-300" alt="{{$pending->username}}" >
        </div>
        <div class="flex flex-col grow">
            <div class="font-bold">
                <a href="/{{$pending->username}}">{{$pending->username}}</a>
            </div>
            <div class="text-sm text-neutral-500">
                {{$pending->name}}
            </div>
        </div>
        @auth
    <div>
        <button wire:click='confirm({{$pending->id}})' class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded-l-lg">{{__('Confirm')}}</button>
        <button wire:click='delete({{$pending->id}})' class="border border-gray-500 px-2 py-1 rounded-r-lg">{{__('Delete')}}</button>
    </div>   
    @endauth
    </li>
        
    @empty
        <li class="w-full p-3 text-center">
            {{__("You are not pending anyone")}}
        </li>
    @endforelse
    </ul>
</div>
