@extends('platform::layouts.dashboard')

@section('title', $team->name)
@section('description', $team->name)

@section('content')

    <div class="hbox hbox-auto-xs hbox-auto-sm">
        <div class="hbox-col w-md bg-white-only b-r bg-auto no-border-xs">
            <ul class="list-group">

                @foreach($groupRemoteAddress as $log)
                    <li class="list-group-item" style="border-right: none">
                        <a href="" class="block">
                            <span class="badge bg-dark text-white pull-right">{{$log->count}}</span>
                            {{$log->remote_address}}
                        </a>
                    </li>
                @endforeach

            </ul>
        </div>
        <div class="hbox-col">

            <div class="wrapper-md bg-white b-b">
                <form class="form-horizontal" method="get">

                    <label class="control-label">Фильтр:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button class="btn btn-default" type="submit"><i class="icon-filter"></i></button>
                            <button class="btn btn-default" type="button"><i class="icon-doc"></i></button>
                        </div>
                        <input type="text" class="form-control" name="search" value="{{request('search')}}" placeholder="Поисковый запрос" aria-label="" aria-describedby="basic-addon1">
                    </div>

                </form>



                @foreach($tags as $key => $value)
                    <a href="#" class="removeTags list-group-item text-ellipsis" data-key="{{$key}}">
                        <span class="badge bg-dark text-white m-r-xs">{{str_after($key,'->')}}</span>
                       {{$value}}
                    </a>
                @endforeach


            </div>

{{--
            <div class="wrapper-xs bg-white b-b">
                <div id="chart"></div>
            </div>
--}}
            <div class="wrapper-md bg-white">
                @foreach($logs as $log)
                    <div class="row m-b-md b-b">
                        <div class="col-sm-12 m-b">
                            <p class="small">
                                <span class="text-black"> {{$log->remote_address}}</span>
                                <time class="pull-right" title="{{$log->created_at}}">{{$log->created_at->toDateString()}}</time>
                            </p>
                            <code>
                                @include('log.json',[
                                    'item'      => $log->message,
                                    'mainKey'   => '',
                                    'padding'   => 0
                                ])
                            </code>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>

        $('.addTags').click(function () {
            axios({
                method: 'post',
                url: window.location.href,
                data: {
                    key: $(this).data('key'),
                    value:  $(this).data('value')
                }
            });
        });

        $('.removeTags').click(function () {
            axios({
                method: 'delete',
                url: window.location.href,
                data: {
                    key: $(this).data('key'),
                }
            });
        });


        /*
                new Chart({
                    parent: "#chart",
                    data: {
                        labels: ["12am-3am", "3am-6am", "6am-9am", "9am-12pm",
                            "12pm-3pm", "3pm-6pm", "6pm-9pm", "9pm-12am"],
                        datasets: [
                            {
                                name: "Some Data", chartType: 'bar',
                                values: [25, 40, 30, 35, 8, 52, 17, -4]
                            },
                            {
                                name: "Another Set", chartType: 'bar',
                                values: [25, 50, -10, 15, 18, 32, 27, 14]
                            },
                            {
                                name: "Yet Another", chartType: 'line',
                                values: [15, 20, -3, -15, 58, 12, -17, 37]
                            }
                        ]
                    },
                    title: "Статистика за последние дни",
                    type: 'line', // or 'bar', 'line', 'pie', 'percentage'
                    height: 150,

                    colors: [
                        '#d0dff9',
                        '#a3c3f9',
                        '#7da1dd',
                        '#5580c7',
                        '#2860bd',
                        '#0a3f98',
                        '#062457',
                        '#0c182c'
                    ]
                });
                */
    </script>

@stop