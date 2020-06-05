@extends('layouts.default')

@push('head')
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Wishlists</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Smart Piggy Bank</li>
                        <li class="breadcrumb-item active"><a
                                href="{{ route('dashboard.wishlists.index') }}">Create Wishlists</a></li>
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
                            <h3 class="card-title">Create Wishlists</h3>
                        </div>
                        <form role="form" method="POST" action="{{ route('dashboard.wishlists.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name"
                                           placeholder="Wishlist Name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="goal">Goal</label>
                                    <input type="number" class="form-control" id="goal"
                                           placeholder="Wishlist Goal" name="goal">
                                </div>
                                <div class="form-group">
                                    <label for="priority">Priority</label>
                                    <input type="number" class="form-control" id="priority"
                                           placeholder="Priority to fill quicker" name="priority">
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
