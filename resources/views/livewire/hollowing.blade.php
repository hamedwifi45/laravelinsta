<li class="flex flex-col md:flex-row text-center">
    <div class="md:mr-1 font-bold md:font-normal">
        {{$this->count}}
    </div>
    <button onclick="Livewire.dispatch('openModal' , {component:'followmodal' ,  arguments: { user_id: {{ $userId }} }})">{{__('following ')}}</button>
</li>