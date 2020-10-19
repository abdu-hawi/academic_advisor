@extends('admin.index')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{!! $title !!}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li><a href="{!! aurl() !!}">Dashboard</a> /</li>
                            <li><a href="{!! aurl('interests') !!}">Interest</a> /</li>
                            <li class="breadcrumb-item active">{!! $title !!}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    @include('admin.layouts.massages')
                    <div class="card">
                        <div class="card-body register-card-body">
                            <form action="{!! aurl('advisors') !!}" method="post">
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
                                <label class="mb-0">Room number:</label>
                                <div class="input-group mb-1">
                                    <input type="number" name="room_no" class="form-control @error('room_no') is-invalid @enderror" placeholder="Room number" value="{!! old('room_no') !!}" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-laptop-code"></span>
                                        </div>
                                    </div>
                                    @error('room_no')
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>
                                <label class="mb-0">Office open from:</label>
                                <div class="input-group mb-1">
                                    <input type="time" value="{!! old("office_from")?old("office_from"):"08:00" !!}" name="office_from" class="form-control @error('office_from') is-invalid @enderror"  required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user-times"></span>
                                        </div>
                                    </div>
                                    @error('office_from')
                                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>

                                <label class="mb-0">Office open to:</label>
                                <div class="input-group mb-3">
                                    <input type="time" value="{!! old("office_to")?old("office_to"):"16:00" !!}" name="office_to" class="form-control @error('office_to') is-invalid @enderror"  required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-user-times"></span>
                                        </div>
                                    </div>
                                    @error('office_to')
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
                        </div>
                        <!-- /.form-box -->
                    </div><!-- /.card -->

                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    @push('jQuery')



    @endpush

@endsection

