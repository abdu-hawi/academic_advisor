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

    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <img src="{!! url('/') !!}/design/dist/img/KAU_logo.png" width="200" height="200">
    </div>

    <!-- /.login-logo -->
    @if($not=="not")
        @include('admin.auth.layouts.massages')
    <div class="card">
        <div class="card-body login-card-body">
            <div class="input-group">
                 <form method="post" action="{!! advisorURL('reSendVerify') !!}" class="col-12">
                     <input type="hidden" name="email" value="{!! $email !!}">
                     {!! csrf_field() !!}
                     <input type="submit" class="btn btn-primary col-12" value="Click here to resend verify link">
                 </form>
            </div>
        </div>
        <!-- /.login-card-body -->
    </div>
    @else
        @include('admin.auth.layouts.massages')
    @endif
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{!! url('/') !!}/design/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{!! url('/') !!}/design/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{!! url('/') !!}/design/dist/js/adminlte.min.js"></script>

</body>
</html>
