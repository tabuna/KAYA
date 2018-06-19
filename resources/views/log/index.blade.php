@extends('platform::layouts.dashboard')

@section('title', $team->name)
@section('description', $team->name)

@section('content')

    <div class="hbox hbox-auto-xs hbox-auto-sm">
        <div class="hbox-col w-md bg-white-only b-r bg-auto no-border-xs">
            <ul class="list-group">

                @foreach($groupRemoteAddress as $log)
                    <li class="list-group-item" style="border-right: none">
                        <a href='?remote_address={{$log->remote_address}}' class="block">
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
                            <button onclick="window.location.href = window.location.pathname" class="btn btn-default" type="button"><i class="icon-doc"></i></button>
                        </div>
                        <div class="input-group-prepend">
                            <input type='text'
                                   name="start_created_at"
                                   id='start_created_at'

                                   value="{{request('start_created_at','')}}" class="form-control datetimepicker w-sm"
                                   data-date-format="YYYY-MM-DD">
                        </div>
                        <div class="input-group-prepend">
                            <input type='text'
                                   name="end_created_at"
                                   id='end_created_at'
                                   value="{{request('end_created_at', '')}}"
                                   class="form-control datetimepicker"
                                   data-date-format="YYYY-MM-DD">
                        </div>
                        <input type="text" class="form-control" name="search" value="{{request('search')}}"
                               placeholder="Поисковый запрос" aria-label="" aria-describedby="basic-addon1">
                    </div>

                </form>


                @foreach($tags as $key => $value)
                    <a href='javascript:;' class="removeTags list-group-item text-ellipsis" data-key="{{$key}}">
                        <span class="badge bg-dark text-white m-r-xs">{{str_after($key,'->')}}</span>
                        {{$value}}
                    </a>
                @endforeach


            </div>

            @if(count($statictics) > 1)


                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab"
                           data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"
                           onclick="initResize()"
                        >
                            По дням</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                           role="tab" aria-controls="profile" aria-selected="false" onclick="initResize()">
                            По месяцам</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="wrapper-xs bg-white b-b">
                            <div id="chart"></div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="wrapper-xs bg-white b-b">
                            <div id="chart2"></div>
                        </div>
                    </div>
                </div>




            @endif

            <div class="wrapper-md bg-white" style="min-height: calc(100% - 200px);">
                @foreach($logs as $log)
                    <div class="row m-b-md b-b">
                        <div class="col-sm-12 m-b">
                            <p class="small">
                                <span class="text-black"> {{$log->remote_address}}</span>
                                <time class="pull-right"
                                      title="{{$log->created_at}}">{{$log->created_at->toDateString()}}</time>
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

            <div class="wrapper center">
                {{ $logs->links() }}
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/frappe-charts@1.1.0/dist/frappe-charts.min.iife.js"></script>
    <!-- or -->
    <script src="https://unpkg.com/frappe-charts@1.1.0/dist/frappe-charts.min.iife.js"></script>
    <script>

        function initResize(){
            setTimeout(function () {
                window.dispatchEvent(new Event('resize'));
            }, 200);
        }


        document.addEventListener('turbolinks:load', function () {
            $('.addTags').click(function () {
                axios({
                    method: 'post',
                    url: window.location.href,
                    data: {
                        key: $(this).data('key'),
                        value: $(this).data('value')
                    }
                }).then(function (response) {
                    Turbolinks.visit(window.location)
                });
            });

            $('.removeTags').click(function () {
                axios({
                    method: 'delete',
                    url: window.location.href,
                    data: {
                        key: $(this).data('key'),
                    }
                }).then(function (response) {
                    Turbolinks.visit(window.location)
                });
            });

/*
            new frappe.Chart({
                parent: "#chart",
                data: {
                    labels: [
                        @foreach($statictics as $statictic)
                            "{{$statictic->date}}",
                        @endforeach
                    ],
                    datasets: [
                        {
                            name: "Some Data",
                            chartType: 'bar',
                            values: [
                                @foreach($statictics as $statictic)
                                    {{$statictic->count}},
                                @endforeach
                            ]
                        }
                    ]
                },
                title: "Статистика за последние дни",
                type: 'bar',
                height: 200,
                colors: [
                    '#ac5ca0',
                ]
            });
*/

            const sometimes = {
                labels: [
                    @foreach($statictics as $statictic)
                        "{{$statictic->date}}",
                    @endforeach
                ],
                datasets: [
                    {
                        name: "Some Data",
                        chartType: 'bar',
                        values: [
                            @foreach($statictics as $statictic)
                            {{$statictic->count}},
                            @endforeach
                        ]
                    },
                ]
            };

            const data = {
                labels: [
                    @foreach($staticsForYear as $statictic)
                        "{{$statictic['name']}}",
                    @endforeach
                ],
                datasets: [
                    {
                        name: "Some Data",
                        chartType: 'bar',
                        values: [
                            @foreach($staticsForYear as $statictic)
                            {{$statictic['count']}},
                            @endforeach
                        ]
                    },
                ]
            };


            new frappe.Chart("#chart", {  // or a DOM element,
                title: "Статистика за последние дни",
                data: sometimes,
                type: 'axis-mixed', // or 'bar', 'line', 'scatter', 'pie', 'percentage'
                height: 250,
                colors: ['#ac5ca0','#7cd6fd', '#743ee2']
            });


            new frappe.Chart("#chart2", {  // or a DOM element,
                title: "Статистика за год",
                data: data,
                type: 'bar', // or 'bar', 'line', 'scatter', 'pie', 'percentage'
                height: 250,
                colors: ['#ac5ca0','#7cd6fd', '#743ee2']
            });


            $("#start_created_at").on("dp.change", function (e) {
                $('#end_created_at').data("DateTimePicker").minDate(e.date);
            });
            $("#end_created_at").on("dp.change", function (e) {
                $('#start_created_at').data("DateTimePicker").maxDate(e.date);
            });
        });
    </script>

@stop