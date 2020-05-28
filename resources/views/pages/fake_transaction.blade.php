@extends('layouts.default')

@push('head')
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Fake Transaction</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Smart Piggy Bank</li>
                        <li class="breadcrumb-item active"><a
                                href="{{ route('dashboard.transactions.fake') }}">Fake Transaction</a></li>
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
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Make Fake Transaction</h3>
                        </div>
                        <form role="form" method="POST" action="{{ route('dashboard.transactions.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="user">User</label>
                                    <select class="form-control" name="user" id="user">
                                        @foreach(\App\Models\User::all() as $user)
                                            <option value="{{$user->id}}">{{ $user->id }} - {{ $user->name }}
                                                - {{ $user->email }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="date">Transaction Date</label>
                                    <input type="datetime-local" class="form-control" id="date"
                                           placeholder="Transaction Date" name="date">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1" style="display: block">Coins</label>
                                    @for($i = 0; $i < 20; $i++)
                                        @include('components.fake_coin_select')
                                    @endfor
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

                <div class="col-md-6"><img src="{{asset('img/piggy-bank.png')}}"
                                           class="img-fluid w-50 rounded mx-auto d-block"/></div>
                <!-- /.col -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('footer')

@endpush
