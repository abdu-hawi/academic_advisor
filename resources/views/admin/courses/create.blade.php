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
                        </div>
                        <div class="card-body register-card-body">
                            {!! Form::open(['url'=>aurl('courses')]) !!}
                            <div><b>Code: </b></div>
                            <div class="mb-0">
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                       name="code" value="{!! old('code') !!}">
                                @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div><b>Name: </b></div>
                            <div class="mb-0">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{!! old('name') !!}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div><b>Credit: </b></div>
                            <div class="mb-0">
                                <input type="text" class="form-control @error('credit') is-invalid @enderror"
                                       name="credit" value="{!! old('credit') !!}">
                                @error('credit')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div><b>Type: </b></div>
                            <div class="mb-0">
                                <select class="form-control @error('type') is-invalid @enderror"
                                        name="type">
                                    <option>Select type of course</option>
                                    <option value="Mandatory" {!! old("type")=="Mandatory"? "selected":"" !!}>Mandatory</option>
                                    <option value="Optional" {!! old("type")=="Optional"? "selected":"" !!}>Optional</option>
                                    <option value="Thesis" {!! old("type")=="Thesis"? "selected":"" !!}>Thesis</option>
                                </select>
                                @error('type')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div><b>Prerequisite: </b></div>
                            <div class="mb-0">
                                {!! Form::select('prerequisite',App\Model\Course::pluck("code",'code'),old('prerequisite'),
                                        ['class'=>"form-control",'placeholder'=>"Select prerequisite course"]) !!}
                                @error('prerequisite')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div><b>Descriptions: </b></div>
                            <div class="mb-3">
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          name="description">
                                    {!! old('description') !!}
                                </textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col-4" style="margin-right: auto;margin-left: auto">
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

