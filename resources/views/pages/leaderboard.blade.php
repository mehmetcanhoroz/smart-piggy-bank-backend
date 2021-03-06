@extends('layouts.default')

@push('head')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <section @if($mobile)style="display: none !important" @endif class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Leaderboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Smart Piggy Bank</li>
                        <li class="breadcrumb-item active"><a
                                href="{{ route('dashboard.leaderboard.index') }}">Leaderboard</a></li>
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
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Weekly Total Transaction</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 40px">#</th>
                                    <th>User</th>
                                    <th>Coins</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $count = 0;
                                @endphp
                                @foreach($top7Transaction as $record)
                                    @php
                                        $count++
                                    @endphp
                                    <tr>
                                        <td><span
                                                class="badge {{$count == 1 ? 'bg-success' : ($count == 2 ? 'bg-primary' : ($count == 3 ? 'bg-info' : ''))}}">{{ $count }}</span>
                                        </td>
                                        <td>{{ $record->user->name }}</td>
                                        <td>{{ $record->count }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->


                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Monthly Total Transaction</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 40px">#</th>
                                    <th>User</th>
                                    <th>Coins</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $count = 0;
                                @endphp
                                @foreach($top30Transaction as $record)
                                    @php
                                        $count++
                                    @endphp
                                    <tr>
                                        <td><span
                                                class="badge {{$count == 1 ? 'bg-success' : ($count == 2 ? 'bg-primary' : ($count == 3 ? 'bg-info' : ''))}}">{{ $count }}</span>
                                        </td>
                                        <td>{{ $record->user->name }}</td>
                                        <td>{{ $record->count }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->


                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Yearly Total Transaction</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 40px">#</th>
                                    <th>User</th>
                                    <th>Coins</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $count = 0;
                                @endphp
                                @foreach($topYearTransaction as $record)
                                    @php
                                        $count++
                                    @endphp
                                    <tr>
                                        <td><span
                                                class="badge {{$count == 1 ? 'bg-success' : ($count == 2 ? 'bg-primary' : ($count == 3 ? 'bg-info' : ''))}}">{{ $count }}</span>
                                        </td>
                                        <td>{{ $record->user->name }}</td>
                                        <td>{{ $record->count }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->


                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Total Transaction</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th style="width: 40px">#</th>
                                    <th>User</th>
                                    <th>Coins</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $count = 0;
                                @endphp
                                @foreach($topTransaction as $record)
                                    @php
                                        $count++
                                    @endphp
                                    <tr>
                                        <td><span
                                                class="badge {{$count == 1 ? 'bg-success' : ($count == 2 ? 'bg-primary' : ($count == 3 ? 'bg-info' : ''))}}">{{ $count }}</span>
                                        </td>
                                        <td>{{ $record->user->name }}</td>
                                        <td>{{ $record->count }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

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
