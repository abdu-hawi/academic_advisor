@section('cssDataTable')
    <link rel="stylesheet" href="{!! url('/') !!}/design/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
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
                            <li><a href="{!! advisorURL() !!}">Dashboard</a> /</li>
                            <li><a href="{!! advisorURL('announcements') !!}">Exams</a> /</li>
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
                            {!! Form::open(['url'=>advisorURL('announcements')]) !!}


                            <div><b class="text-primary">Select students you want send to him: </b></div>
                            <div class="mb-1">
                                <div class="row">
                                    <?php
                                    use App\Model\Collect\Student;
                                    $students = Student::query()->where('advisor_id',advisor()->user()->id)->get();
                                    for($i=0;$i<count($students);$i++){
                                        echo '
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="icheck-success">
                                                <input type="checkbox"id="s'.$i.'" name="student_id['.$i.']" value="'.$students[$i]->id.'">
                                                <label for="s'.$i.'"> '.$students[$i]->name.'</label>
                                            </div>
                                        </div>
                                        ';
                                    }
                                    ?>

                                </div>
                            </div>

                            <div><label for="msg" class="text-primary">Message: </label></div>
                            <div class="mb-3">
                                <textarea type="text" class="form-control @error('message') is-invalid @enderror"
                                          name="message" id="msg" placeholder="Write your message" required>{!! old('message') !!}</textarea>
                                @error('message')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col-2">
                                        <button type="submit" class="btn btn-primary btn-block">Send</button>
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

