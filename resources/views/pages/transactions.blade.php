@extends('layouts.default')

@push('head')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Transactions</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Smart Piggy Bank</li>
                        <li class="breadcrumb-item active"><a
                                href="{{ route('dashboard.transactions.index') }}">Transactions</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @if(Session::has('message'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('message')}}
                </div>
        @endif
        <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="usersDataTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Coins</th>
                                    <th>User</th>
                                    <th>Value</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->created_at }}</td>
                                        <td>
                                            @foreach($transaction->coins as $coin)
                                                <img
                                                    src="{{ asset('img/coins/' . $coin->value * 100 . '.png') }}"
                                                    width="40">
                                            @endforeach
                                            @for($i = 0; $i < $transaction->unknown_item_count; $i++)
                                                <img
                                                    src="{{ asset('img/coins/unknown.png') }}"
                                                    width="40">
                                            @endfor
                                        </td>
                                        <td>
                                            <img
                                                src="{{ $transaction->user->is_parent ? asset('img/user.png') : asset('img/child.png') }}"
                                                class="img-circle elevation-2" alt="User Image"
                                                width="40"> {{ $transaction->user->name }}</td>
                                        <td>{{ $transaction->value }} &#8378;</td>
                                        <td>@if($transaction->isSuccess) <i class="fas fa-check text-green"></i>
                                            Success @else <i class="fas fa-times text-red"></i> Failed @endif</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-danger"
                                                        onclick="deleteIt('{{ route('dashboard.transactions.delete', $transaction->id) }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
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
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('footer')
    <!-- DataTables -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{  asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>

    <script>
        $(function () {
            $("#usersDataTable").DataTable();
        });
    </script>
@endpush
