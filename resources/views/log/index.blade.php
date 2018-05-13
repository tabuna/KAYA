@extends('dashboard::layouts.dashboard')

@section('title', $team->name)
@section('description', $team->name)

@section('content')

    <div  class="hbox hbox-auto-xs hbox-auto-sm">
        <div class="hbox-col w-md bg-white-only b-r bg-auto no-border-xs">
            <ul class="list-group">

                @foreach($groupRemoteAddress as $ip => $address)
                    <li class="list-group-item" style="border-right: none">
                        <a href="" class="block">
                            <span class="badge bg-dark text-white pull-right">{{count($address)}}</span>
                            {{$ip or 'unknown'}}
                        </a>
                    </li>
                @endforeach

            </ul>
        </div>
        <div class="hbox-col">
            <div class="wrapper bg-white b-b">
                <div id="chart"></div>
            </div>
            <div class="wrapper-md">
                <div class="row">
                    <div class="col-sm-12">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>


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
            title: "My Awesome Chart",
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
    </script>

@stop