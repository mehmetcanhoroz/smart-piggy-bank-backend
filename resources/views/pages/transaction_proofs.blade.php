@extends('layouts.default')

@push('head')
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="{{ asset('plugins/ekko-lightbox/ekko-lightbox.css') }}">
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Transaction Proofs</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Smart Piggy Bank</li>
                        <li class="breadcrumb-item active"><a
                                href="{{ route('dashboard.transaction_proofs.index') }}">Transaction Proofs</a></li>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @foreach($transactionProofs as $proof)
                                    <div class="col-sm-2">
                                        <a href="{{ $proof->image }}"
                                           data-toggle="lightbox"
                                           data-title="Transaction Proof - {{ $proof->transaction_id }}" data-gallery="gallery">
                                            <img src="{{ $proof->image }}"
                                                 class="img-fluid mb-2"
                                                 alt="Proof Image"/>
                                        </a>
                                    </div>
                                @endforeach
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
    <!-- Ekko Lightbox -->
    <script src="{{ asset('plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>

    <script>
        $(function () {
            $(document).on('click', '[data-toggle="lightbox"]', function (event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });
        })
    </script>
@endpush
