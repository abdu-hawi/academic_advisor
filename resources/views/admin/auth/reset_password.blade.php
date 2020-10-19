@section('title')
    Reset Password
@endsection

@include('admin.auth.layouts.header')

<b>Reset Password</b>
</div>
<!-- /.login-logo -->
<div class="card">
    <div class="card-body login-card-body">

        @include('admin.auth.layouts.massages')

        <p class="login-box-msg">Please write your new password</p>

        <form method="post">
            {!! csrf_field() !!}
            <div class="input-group mb-3">
                <input type="email" class="form-control" name="email" value="{!! $data->email !!}" placeholder="Email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Password confirmation">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">

                <!-- /.col -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <p class="mt-3 mb-1">
            <a href="{!! route('admin.login') !!}">Login</a>
        </p>
    </div>
    <!-- /.login-card-body -->
</div>
</div>
<!-- /.login-box -->


</body>
</html>
