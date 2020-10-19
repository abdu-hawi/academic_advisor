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
<div class="login-box col-4">
    <div class="login-logo">
        <img src="{!! url('/') !!}/design/dist/img/KAU_logo.png" width="200" height="200">
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
{{--            @include('admin.auth.layouts.massages')--}}
            @if ($errors->has('interest_id'))
                <div class="alert alert-danger card-body col-12" style="margin-left: auto;margin-right: auto;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{!! studentURL('register') !!}" method="post">
                {!! csrf_field() !!}

                <label class="mb-0">Name:</label>
                <div class="input-group mb-1">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{!! old('name') !!}" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
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
                <div class="input-group mb-1">
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
                <label class="mb-0">Phone number:</label>
                <div class="input-group mb-1">
                    <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone number" value="{!! old('phone') !!}" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                        </div>
                    </div>
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
{{--                <label class="mb-0">GPA:</label>--}}
{{--                <div class="input-group mb-1">--}}
{{--                    <input type="number" min="0" max="5" name="gpa" class="form-control @error('gpa') is-invalid @enderror" placeholder="GPA" value="{!! old('gpa')?old('gpa'):0 !!}" required>--}}
{{--                    <div class="input-group-append">--}}
{{--                        <div class="input-group-text">--}}
{{--                            <span class="fas fa-laptop-code"></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    @error('gpa')--}}
{{--                        <span class="invalid-feedback" role="alert">--}}
{{--                            <strong>{{ $message }}</strong>--}}
{{--                        </span>--}}
{{--                    @enderror--}}
{{--                </div>--}}
                <label class="mb-0">Interest:</label>
                <div class="input-group mb-1">
                    {!! Form::select('interest_id',App\Model\Interest::pluck("name",'id'),old('interest_id'),
                                        ['class'=>"form-control",'placeholder'=>"Select interest field"]) !!}

                </div>

                <label class="mb-0">How many course you want in a level:</label>
                <div class="mb-3">
                    <select class="form-control @error('num_course') is-invalid @enderror"
                            name="num_course">
                        <option>Select number course you want learn</option>
                        <option value="3" {!! old("num_course")==3? "selected":"" !!}>3 courses</option>
                        <option value="4" {!! old("num_course")==4? "selected":"" !!}>4 courses</option>
                    </select>
                    @error('num_course')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-6 mb-2">
                        <button type="submit" class="btn btn-success btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mb-0">
                <a href="{!! advisorURL('login') !!}" class="text-center text-success">Sign In</a>
            </p>

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
