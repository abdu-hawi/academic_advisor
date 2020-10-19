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


        @include('admin.auth.layouts.massages')
    <div class="card">
        <div class="card-body login-card-body">
            <div class="input-group">
                 <form method="post" action="{!! advisorURL('reset/password') !!}">
                     <input type="hidden" name="token" value="{!! $token !!}">
                     {!! csrf_field() !!}
                     <label class="mb-0">Email:</label>
                     <div class="input-group mb-1">
                         <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{!! old('email') !!}" required>
                         <div class="input-group-append">
                             <div class="input-group-text">
                                 <span class="fas fa-envelope"></span>
                             </div>
                         </div>
                         @error('email')
                         <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                         @enderror
                     </div>
                     <label class="mb-0">Password:</label>
                     <div class="input-group mb-1">
                         <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                         <div class="input-group-append">
                             <div class="input-group-text">
                                 <span class="fas fa-lock"></span>
                             </div>
                         </div>
                         @error('password')
                         <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                         @enderror
                     </div>
                     <label class="mb-0">Confirmation Password:</label>
                     <div class="input-group mb-3">
                         <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Password Confirmation" required>
                         <div class="input-group-append">
                             <div class="input-group-text">
                                 <span class="fas fa-lock"></span>
                             </div>
                         </div>
                         @error('password_confirmation')
                         <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                         @enderror
                     </div>
                     <input type="submit" class="btn btn-primary" value="Reset Password">
                 </form>
            </div>
        </div>
        <!-- /.login-card-body -->
    </div>
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
