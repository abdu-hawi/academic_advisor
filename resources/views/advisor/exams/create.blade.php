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
                            <li><a href="{!! advisorURL() !!}">Dashboard</a> /</li>
                            <li><a href="{!! advisorURL('exams') !!}">Exams</a> /</li>
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
                            {!! Form::open(['url'=>advisorURL('exams')]) !!}


                            <div><b>Event Name: </b></div>
                            <div class="mb-0">
{{--                                {!! Form::select('course_id',App\Model\Course::select(DB::raw('CONCAT(code, " - ", name) AS full_name, id'))--}}
{{--                                        ->where('code','!=','699')->pluck('full_name', 'id'),old('course_id'),--}}
{{--                                        ['class'=>"form-control",'placeholder'=>"Select course", 'required']) !!}--}}
                                <textarea type="text" class="form-control @error('name') is-invalid @enderror"
                                          name="name" required>{!! old('name') !!}</textarea>
                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div><b>Date: </b></div>
                            <div class="mb-0">
                                <input type="date" class="form-control @error('date') is-invalid @enderror"
                                       name="date" value="{!! old('date') !!}" required>
                                @error('date')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

{{--                            <div><b>Time: </b></div>--}}
{{--                            <div class="mb-3">--}}
{{--                                <input type="time" class="form-control @error('time') is-invalid @enderror"--}}
{{--                                       name="time" value="{!! old('time') !!}" required>--}}
{{--                                @error('time')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}

                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-primary btn-block">Add</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            {!! Form::close() !!}
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

