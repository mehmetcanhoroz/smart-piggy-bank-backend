@extends('layouts.default')

@push('head')
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Smart Piggy Bank</li>
                        <li class="breadcrumb-item active"><a
                                href="{{ route('dashboard.users.index') }}">Edit User</a></li>
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
                            <h3 class="card-title">Edit User</h3>
                        </div>
                        <form role="form" method="POST" action="{{ route('dashboard.users.update', $user->id) }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="email">E-Mail</label>
                                    <input type="email" class="form-control" id="email" disabled readonly
                                           placeholder="E-Mail" name="email" value="{{$user->email}}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" value="{{$user->name}}"
                                           placeholder="Name" name="name" required min="3" minlength="3">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password"
                                           placeholder="Password" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="parent">Is Parent</label>
                                    <input type="checkbox" class="" id="parent" {{$user->is_parent ? 'checked' : ''}}
                                           placeholder="parent" name="parent">
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
