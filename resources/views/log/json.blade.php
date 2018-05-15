@if(is_array($item))

    <div style="padding-left: {{$padding}}em">
        @foreach($item as $key => $value)

                @if(!is_array($value))
                    <div>
                @endif
                        
                "{{ $key }}": @include('log.json', [
                    'item' => $value,
                    'mainKey' => $mainKey .'.'. $key,
                    'padding' => $padding + 0.45
                 ])

                @if(!is_array($value))
                    </div>
                @endif

        @endforeach
    </div>
@else
            <a href="#{{$mainKey}}">{{$item}}</a>
        @php
            $mainKey='';
            $padding=0;
        @endphp
@endif