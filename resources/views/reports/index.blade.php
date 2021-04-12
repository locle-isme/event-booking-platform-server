@extends('layouts.app')
@section('content')
    <canvas id="myChart" width="400" height="200"></canvas>
    <script>
        let reportData = @json($event->sessions);
        let titles = [];
        let capacities = [];
        let attendees = [];
        let bgColors = [];
        reportData.forEach(row => {
            titles.push(row.title);
            capacities.push(row.capacity);
            attendees.push(row.attendee);
            if (row.capacity > row.attendee) {
                bgColors.push('#41eea6');
            } else {
                bgColors.push('#fa3343');
            }
        })
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: titles,
                datasets: [{
                    label: '# of Attendee',
                    data: attendees,
                    backgroundColor: bgColors,
                    borderWidth: 1
                },
                    {
                        label: '# of Capacity',
                        data: capacities,
                        backgroundColor: '#52b6ff',
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
