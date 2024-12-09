<div>
    @if ($this->likes > 0)
        {{__('liked by')}}
        <strong>
            <a href="/{{$this->firstuser}}">{{$this->firstuser}}</a>
        </strong>        
    @endif
    @if ($this->likes > 1)
        {{__('and')}} <strong>{{__('other')}}</strong>

    @endif
</div>
