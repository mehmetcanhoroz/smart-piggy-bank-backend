<!doctype html>
<html>
<head>
@include('includes.head')
<!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
</head>
<body class="hold-transition login-page">
<!-- Site wrapper -->

<div class="login-box">
    <div class="login-logo">
        <a href="/"><b>Smart</b> Piggy Bank</a>
    </div>
    <!-- /.login-logo -->
    @yield('content')
</div>
<!-- /.login-box -->

<!-- ./wrapper -->
@include('includes.footer_include')
</body>
</html>
