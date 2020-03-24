<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Smart Piggy Bank</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('welcome/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('welcome/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic"
          rel="stylesheet" type="text/css">
    <link href="{{ asset('welcome/vendor/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('welcome/css/stylish-portfolio.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

<!-- Header -->
<header class="masthead d-flex">
    <div class="container text-center my-auto">
        <h1 class="mb-1">Smart Piggy Bank</h1>
        <h3 class="mb-5">
            <em>Saving money with tech</em>
        </h3>
        @guest
            <a class="btn btn-primary btn-xl js-scroll-trigger" href="{{ route('dashboard.login') }}">Login</a>
            <a class="btn btn-danger btn-xl js-scroll-trigger" href="{{ route('dashboard.register') }}">Register</a>
        @else
            <a class="btn btn-success btn-xl js-scroll-trigger" href="{{ route('dashboard.index') }}">Dashboard</a>
        @endguest
    </div>
    <div class="overlay"></div>
</header>

<!-- About -->
<section class="content-section bg-light" id="about">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <h2>Next-gen piggy bank!</h2>
                <p class="lead">We try to provide you saving habits with new technology</p>
            </div>
        </div>
    </div>
</section>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded js-scroll-trigger" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript -->
<script src="{{ asset('welcome/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('welcome/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Plugin JavaScript -->
<script src="{{ asset('welcome/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for this template -->
<script src="{{ asset('welcome/js/stylish-portfolio.min.js') }}"></script>

</body>

</html>
