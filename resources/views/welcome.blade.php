<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{!! !empty($title)?$title:'Advisor Academic' !!}@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{!! url('/') !!}/design/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{!! url('/') !!}/design/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{!! url('/') !!}/design/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <style>
        .login-page, .register-page {
            -ms-flex-align: center;
            align-items: center;
            background: #f1fdec;
            display: -ms-flexbox;
            display: flex;
            height: 100vh;
            -ms-flex-pack: center;
            justify-content: center;
        }
        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
            color: #4ca870;
            background-color: #fff;
            border-color: #dee2e6 #dee2e6 #fff;
        }
        .nav-tabs .nav-link {
            border: 1px solid transparent;
            border-top-left-radius: .25rem;
            border-top-right-radius: .25rem;
            color: #495057;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <img src="{!! url('/') !!}/design/dist/img/KAU_logo.png" width="200" height="200">
    </div>
    <!-- /.login-logo -->
    <div class="card">
{{--        <nav class="nav nav-tabs nav-fill">--}}
{{--            <a class="nav-item nav-link active" href="#student">Student</a>--}}
{{--            <a class="nav-item nav-link" href="#advisor">Advisor</a>--}}
{{--        </nav>--}}
        <ul class="nav nav-tabs nav-fill" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#student">Student</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#advisor">Advisor</a>
            </li>
        </ul>
        <div class="card-body login-card-body">
            @include('admin.auth.layouts.massages')
            <p class="login-box-msg">Sign in to start your session</p>

            <div class="tab-content">
                <div id="student" class="container tab-pane active">
                    @include('student_login')
                </div>
                <div id="advisor" class="container tab-pane fade">
                    @include('advisor_login')
                </div>
            </div>

        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{!! url('/') !!}/design/plugins/jquery/jquery.min.js"></script>
{{--<!-- Bootstrap 4 -->--}}
<script src="{!! url('/') !!}/design/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
{{--<!-- AdminLTE App -->--}}
{{--<script src="{!! url('/') !!}/design/dist/js/adminlte.min.js"></script>--}}

</body>
</html>
