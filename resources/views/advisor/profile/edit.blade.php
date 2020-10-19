@section('cssDataTable')
    <link rel="stylesheet" href="{!! url('/') !!}/design/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endsection

@extends('advisor.index')

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
                            <li><a href="{!! advisorURL('profile') !!}">Profile</a> /</li>
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

{{--                    @include('admin.layouts.massages')--}}

                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{!! advisorURL('profile/'.$advisor->id) !!}" method="post">
                                {!! csrf_field() !!}
                                {!! method_field('put') !!}

                                <label class="mb-0"><span class="text-danger">*</span> Name:</label>
                                <div class="input-group mb-1">
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{!! old('name')?old('name'):$advisor->name !!}" required>
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
                                <label class="mb-0"><span class="text-danger">*</span> Email:</label>
                                <div class="input-group mb-1">
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{!! old('email')?old('email'):$advisor->email !!}" required>
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
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
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
                                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Password Confirmation">
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
                                <label class="mb-0"><span class="text-danger">*</span> Phone number:</label>
                                <div class="input-group mb-1">
                                    <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone number" value="{!! old('phone')?old('phone'):$advisor->phone !!}" required>
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
                                <label class="mb-0"><span class="text-danger">*</span> Room number:</label>
                                <div class="input-group mb-1">
                                    <input type="number" name="room_no" class="form-control @error('room_no') is-invalid @enderror" placeholder="Room number" value="{!! old('room_no')?old('room_no'):$advisor->room_no !!}" required>
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
                                <label class="mb-0"><span class="text-danger">*</span> Office open from:</label>
                                <div class="input-group mb-1">
                                    <input type="time" value="{!! old("office_from")?old('office_from'):$advisor->office_from !!}" name="office_from" class="form-control @error('office_from') is-invalid @enderror"  required>
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

                                <label class="mb-0"><span class="text-danger">*</span> Office open to:</label>
                                <div class="input-group mb-3">
                                    <input type="time" value="{!! old("office_to")?old('office_to'):$advisor->office_to !!}" name="office_to" class="form-control @error('office_to') is-invalid @enderror"  required>
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
                                    <div class="mb-2">
                                        <button type="submit" class="btn btn-success btn-block">Update</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
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

        <script src="{!! url('/') !!}/design/plugins/datatables/jquery.dataTables.js"></script>
        <script src="{!! url('/') !!}/design/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
        <script src="{!! url('/') !!}/datatable/js/dataTables.buttons.min.js"></script>
        <script src="{!! url('/') !!}/datatable/js/buttons.server-side.js"></script>




    @endpush

@endsection

