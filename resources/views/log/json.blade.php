@if(is_array($item))

    <div style="padding-left: {{$padding}}em">
        @foreach($item as $key => $value)

                @if(!is_array($value))
                    <div>
                @endif
                        
                "{{ $key }}": @include('log.json', [
                    'item' => $value,
                    'mainKey' => $mainKey .'->'. $key,
                    'padding' => $padding + 0.80
                 ])

                @if(!is_array($value))
                    </div>
                @endif

        @endforeach
    </div>
@else
            <a href="#" class="addTags" data-key="{{$mainKey}}" data-value="{{$item}}">{{$item}}</a>
        @php
            $mainKey='';
            $padding=0;
        @endphp
@endif