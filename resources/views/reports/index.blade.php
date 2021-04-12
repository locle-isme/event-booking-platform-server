@extends('layouts.app')
@section('content')
    <canvas id="myChart" width="400" height="200"></canvas>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var reportData = @json($event->sessions);
        var titles = [];
        var attendees = [];
        var capacity = [];
        var colorList = [];
        reportData.forEach(row => {
            titles.push(row.title);
            attendees.push(row.attendee);
            capacity.push(row.capacity);
            if (row.attendee > row.capacity) {
                colorList.push('#ff3a3a');
            } else {
                colorList.push('#18ec85')
            }

        })
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: titles,
                datasets: [
                    {
                        label: '# of Attendees',
                        data: attendees,
                        backgroundColor: colorList,

                        borderWidth: 1
                    },
                    {
                        label: '# of Capacity',
                        data: capacity,
                        backgroundColor: '#4dc3f5',
                        borderWidth: 1
                    }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection
