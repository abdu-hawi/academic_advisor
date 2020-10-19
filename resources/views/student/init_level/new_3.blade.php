@extends('student.index')

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
                            <li><a href="{!! studentURL() !!}">Dashboard</a> /</li>
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
                        <!-- /.card-header -->
                        <div class="card-body">
                            {!! Form::open(['url'=>studentURL('plans/init/'.$id)]) !!}
                            <div class="mb-3">
                                <?php
                                use App\Model\Collect\Score;
                                $countCourse = count($level[0]);
                                $gpa = 0;
                                $gpaLevel1 = 0;
                                foreach($level[0] as $l) {
                                    $gpaLevel1 += Score::query()->where('course_id',$l->id)->average("score");
                                }
                                $gpaLevel1 = round($gpaLevel1/$countCourse,2);
                                $gpa += $gpaLevel1;
                                ?>
                                <h6><b class="text-dark">LEVEL 1</b> | <b class="text-red ml-2">GPA: </b>{!! $gpaLevel1 !!}</h6>
                                @include('student.init_level.level_new3_1')
                            </div>
                            <div class="mb-3">
                                <?php
                                $countCourse = count($level[1][0]);
                                $gpaLevel2 = 0;
                                foreach($level[1][0] as $l) {
                                    $gpaLevel2 += Score::query()->where('course_id',$l->id)->average("score");
                                }
                                $gpaLevel2 = round($gpaLevel2/$countCourse,2);
                                $gpa += $gpaLevel2;
                                ?>
                                <h6><b class="text-dark">LEVEL 2</b> | <b class="text-red ml-2">GPA: </b>{!! $gpaLevel2 !!}</h6>
                                @include('student.init_level.level_new3_2')
                            </div>
                            <div class="mb-3">
                                <?php
                                $countCourse = count($level[2][0]);
                                $gpaLevel3 = 0;
                                foreach($level[2][0] as $l) {
                                    $gpaLevel3 += Score::query()->where('course_id',$l->id)->average("score");
                                }
                                $gpaLevel3 = round($gpaLevel3/$countCourse,2);
                                $gpa += $gpaLevel3;
                                ?>
                                <h6><b class="text-dark">LEVEL 3</b> | <b class="text-red ml-2">GPA: </b>{!! $gpaLevel3 !!}</h6>
                                @include('student.init_level.level_new3_3')
                            </div>
                            <div class="mb-3">
                                <?php
                                $gpaLevel4 = Score::query()->where('course_id',$level[3]->id)->average("score");
                                $gpaLevel4 = round($gpaLevel4,2);
                                $gpa += $gpaLevel4;
                                ?>
                                <h6><b class="text-dark">LEVEL 4</b> | <b class="text-red ml-2">GPA: </b>{!! $gpaLevel4 !!}</h6>
                                @include('student.init_level.level_new3_4')
                            </div>

                            <hr>
                            <h5><b class="text-red mr-2">GPA:</b>{!! round($gpa/4,2) !!}</h5>
                            <input type="submit" class="btn btn-success" value="Agree Plane"/>
                            <a href="{!! studentURL('plans/edit/'.$id) !!}"><input type="button" class="btn btn-dark" value="Edit Plane"/></a>
                            {!! Form::close() !!}
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

{{--        <script src="{!! url('/') !!}/design/plugins/datatables/jquery.dataTables.js"></script>--}}
{{--        <script src="{!! url('/') !!}/design/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>--}}
{{--        <script src="{!! url('/') !!}/datatable/js/dataTables.buttons.min.js"></script>--}}
{{--        <script src="{!! url('/') !!}/datatable/js/buttons.server-side.js"></script>--}}




    @endpush

@endsection
