<form action="{!! studentURL('login') !!}" method="post">
    {!! csrf_field() !!}
    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
    </div>
    <div class="input-group mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <div class="icheck-success">
                <input type="checkbox" id="rememberMe" name="rememberMe" {!! old('rememberMe')=="on"?"checked":"" !!}>
                <label for="rememberMe">
                    Remember Me
                </label>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-4">
            <button type="submit" class="btn btn-success btn-block">Sign In</button>
        </div>
        <!-- /.col -->
    </div>
</form>

<p class="mb-1">
    <a href="{!! studentURL('forgotPassword') !!}" class="text-success">I forgot my password</a>
</p>
<p class="mb-0">
    <a href="{!! studentURL('register') !!}" class="text-center text-success">Register a new membership</a>
</p>
