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
                            <li><a href="{!! aurl('courses') !!}">Courses</a> /</li>
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

                    <div class="card">
                        <div class="card-body col-8" style="margin-left: auto;margin-right: auto;">
                            @include('admin.layouts.massages')
                        </div>
                        <div class="card-body register-card-body col-6" style="margin-left: auto;margin-right: auto;">
                            {!! Form::open(['url'=>aurl('interests/'.$interest->id),'method'=>'put']) !!}

                            <div><b>Name: </b></div>
                            <div class="mb-0">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{!! $interest->name !!}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div><b>First Course: </b></div>
                            <div class="mb-0">
                                {!! Form::select('first_course',App\Model\Course::where("type","Optional")->pluck("code",'id'),$interest->first_course,
                                        ['class'=>"form-control",'placeholder'=>"Select first course"]) !!}
                            </div>
                            <div><b>Second Course: </b></div>
                            <div class="mb-3">
                                {!! Form::select('second_course',App\Model\Course::where("type","Optional")->pluck("code",'id'),$interest->second_course,
                                        ['class'=>"form-control",'placeholder'=>"Select second course"]) !!}
                            </div>

                                <div class="row">
                                    <div class="col-4" style="margin-right: auto;margin-left: auto">
                                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                                    </div>
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

