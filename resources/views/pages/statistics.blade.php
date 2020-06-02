@extends('layouts.default')

@push('head')

@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header" @if($mobile)style="display: none !important" @endif>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Statistics</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Smart Piggy Bank</li>
                        <li class="breadcrumb-item active"><a
                                href="{{ route('dashboard.statistics.index') }}">Statistics</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="chart">
                                    <!-- PIE CHART -->
                                    <canvas id="pieChart"
                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="chart">
                                    <!-- PIE CHART -->
                                    <canvas id="pieChartUnknown"
                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="chart">
                                    <!-- PIE CHART -->
                                    <canvas id="pieChartFailed"
                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- BAR CHART -->
                                <div class="chart">
                                    <canvas id="barChart"
                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- BAR CHART -->
                                <div class="chart">
                                    <canvas id="barChartDay"
                                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('footer')
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

    <script>
        $(function () {
            var donutData = {
                labels: [
                    @foreach($data['coin'] as $coin)
                        '{{ $coin->value }} TL',
                    @endforeach
                ],
                datasets: [
                    {
                        data: [
                            @foreach($data['coin'] as $coin)
                                '{{ $coin->coin_count }}',
                            @endforeach
                        ],
                        backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                    }
                ]
            };
            var donutDataUnknown = {
                labels: [
                    'Unknown Item', 'Coin'
                ],
                datasets: [
                    {
                        data: [
                            {{ $data['coinUnknown']['unknown_coin'] }},
                            {{ $data['coinUnknown']['coin'] }},
                        ],
                        backgroundColor: ['#f39c12', '#3c8dbc', '#d2d6de', '#f56954', '#00a65a', '#00c0ef'],
                    }
                ]
            };
            var donutDataFailed = {
                labels: [
                    'Success Transactions', 'Failed Transactions'
                ],
                datasets: [
                    {
                        data: [
                            {{ $data['failed']['success'] }},
                            {{ $data['failed']['failed'] }},
                        ],
                        backgroundColor: ['#00a65a', '#f56954', '#00c0ef', '#3c8dbc', '#f39c12', '#d2d6de'],
                    }
                ]
            };

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
            var pieData = donutData;
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            };
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var pieChart = new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            });
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvasUnknown = $('#pieChartUnknown').get(0).getContext('2d');
            var pieDataUnknown = donutDataUnknown;
            var pieOptionsUnknown = {
                maintainAspectRatio: false,
                responsive: true,
            };
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var pieChartUnknown = new Chart(pieChartCanvasUnknown, {
                type: 'pie',
                data: pieDataUnknown,
                options: pieOptionsUnknown
            });
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvasFailed = $('#pieChartFailed').get(0).getContext('2d');
            var pieDataFailed = donutDataFailed;
            var pieOptionsFailed = {
                maintainAspectRatio: false,
                responsive: true,
            };
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var pieChartFailed = new Chart(pieChartCanvasFailed, {
                type: 'pie',
                data: pieDataFailed,
                options: pieOptionsFailed
            });


            //-------------
            //- BAR CHART -
            //-------------

            var areaChartData = {
                labels: [
                    @foreach($data['monthly'] as $month)
                        '{{ $month->month_transaction }}',
                    @endforeach
                ],
                datasets: [
                    {
                        label: 'Transaction Counts by Month',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [
                            @foreach($data['monthly'] as $month)
                                '{{ $month->total_transaction }}',
                            @endforeach
                        ]
                    },
                ]
            };

            var areaChartDataDay = {
                labels: [
                    @foreach($data['daily'] as $day)
                        '{{ $day->day_transaction }}',
                    @endforeach
                ],
                datasets: [
                    {
                        label: 'Transaction Counts by Day',
                        backgroundColor: 'rgba(188,70,124,0.9)',
                        borderColor: 'rgba(188,70,124,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [
                            @foreach($data['daily'] as $day)
                                '{{ $day->total_transaction }}',
                            @endforeach
                        ]
                    },
                ]
            };

            var barChartCanvas = $('#barChart').get(0).getContext('2d');
            var barChartCanvasDay = $('#barChartDay').get(0).getContext('2d');
            var barChartData = jQuery.extend(true, {}, areaChartData);
            var barChartDataDay = jQuery.extend(true, {}, areaChartDataDay);
            var temp0 = areaChartData.datasets[0];
            var temp0Day = areaChartDataDay.datasets[0];
            //var temp1 = areaChartData.datasets[1];
            barChartData.datasets[0] = temp0;
            barChartDataDay.datasets[0] = temp0Day;
            //barChartData.datasets[1] = temp0;

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            min: 0
                        }
                    }]
                }
            };

            var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            });

            var barChartDay = new Chart(barChartCanvasDay, {
                type: 'bar',
                data: barChartDataDay,
                options: barChartOptions
            });
        })
    </script>
@endpush


@push('footer')

    @if($mobile)
        <script>
            $(document).ready(function () {
                $('.main-header').hide();
                $('.content-header').hide();
                $('.main-footer').hide();
                $('.content-wrapper').css("background-color", "white");
                $('.content-wrapper').css("padding-top", "20px");
            });
        </script>
    @endif

@endpush
