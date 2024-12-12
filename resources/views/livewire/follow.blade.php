<div>
@if(auth()->id() != $user_id)   
<a wire:click='togle_follow'
    class="w-30 text-blue-400 cursor-pointer text-sm font-bold px-3 text-center">
{{__($follow_state)}}
</a>
@endif
</div>
