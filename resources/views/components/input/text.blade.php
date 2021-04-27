@php($type = $type ?? 'text')
@php($checkType = $checkType ?? '')

<p class="input input_text @if($type !== 'text')input_{{$type}}@endif">
    @if(isset($type) && $type == 'textarea')
        <textarea class="input-input"
                  name="{{$name}}"
                  placeholder="{{$placeholder}}"
                  autocomplete="on"
                  data-val-type="{!!$checkType!!}">{{$value ?? ''}}</textarea>
    @else
        <input class="input-input"
               name="{{$name}}"
               placeholder="{{$placeholder}}"
               type="{!! $type !!}"
               value="{{$value ?? ''}}"
               autocomplete="{!! $autocomplete ?? 'on' !!}"
               data-val-type="{!!$checkType!!}"/>
    @endif
</p>
