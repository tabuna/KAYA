<div class="wrapper-xs bg-white b-b">
    <div id="chart"></div>
</div>


<script src="https://cdn.jsdelivr.net/npm/frappe-charts@1.1.0/dist/frappe-charts.min.iife.js"></script>
<!-- or -->
<script src="https://unpkg.com/frappe-charts@1.1.0/dist/frappe-charts.min.iife.js"></script>

<script>
    document.addEventListener('turbolinks:load', function () {

        var data = {
            labels: [
                @foreach($days as $day)
                    "{{$day}}",
                @endforeach
            ],
            datasets: [
                    @foreach($statics as $key => $values)
                {
                    name: "{{$key}}",
                    chartType: 'line',
                    values: [
                        @foreach($values as $value)
                        {{$value}},
                        @endforeach
                    ]
                },
                @endforeach
            ]
        };

        new frappe.Chart("#chart", {  // or a DOM element,
            title: "Статистика по всем проектам за последние дни",
            data: data,
            type: 'axis-mixed', // or 'bar', 'line', 'scatter', 'pie', 'percentage'
            height: 450,
        });
    });

</script>