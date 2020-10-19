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
                            <?php
                                $courseInLevel = ceil(count($coursesFinish)/$level_finish); // 6/2=3 |
                                $cntCourse=0;
                                $restCourse = count($coursesFinish);
                                $countCourse=0;
                                $i=1;
                                $bg = ['gainsboro','beige','aliceblue','seashell'];
                                $is606 = false;
                                $isInterest = false;
                                $allLevel = 0;
                            ?>
                            @for(;$i<=$level_finish;$i++)
                                <div class="mb-3">
                                    <h6><b class="text-dark">LEVEL{!! $i !!}</b> | <b class="text-red ml-2">GPA: </b>{!! $gpa !!}</h6>
                                    <table class="table table-bordered" style="background: {!! $bg[$i] !!};">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Course code</th>
                                            <th class="text-center">Course name</th>
                                            <th class="text-center">Credit</th>
                                            <th class="text-center">Prerequisite</th>
                                            <th class="text-center">type</th>
{{--                                            <th class="text-center">GPA</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody class="level-1">
                                        <?php
                                        $cnt = 0;
                                        if ($i==$level_finish && $restCourse > 0){
                                            $countCourse = $restCourse;
                                        }else{
                                            $countCourse = $courseInLevel;
                                        }
                                        ?>
                                        @for($m=1;$m<=$countCourse;$m++)
                                            <?php
                                                if ($coursesFinish[$cntCourse]->code == 606) $is606 = true;
                                                if ($coursesFinish[$cntCourse]->code == 620 ||
                                                    $coursesFinish[$cntCourse]->code == 630 ||
                                                    $coursesFinish[$cntCourse]->code == 640 ||
                                                    $coursesFinish[$cntCourse]->code == 696  ) $isInterest = true;
                                            ?>

                                            <tr draggable="true">
                                                <input type="hidden" name="level[{!! $i !!}][{!! $cnt !!}]" value="{!! $coursesFinish[$cntCourse]->id !!}"/>
                                                <input type="hidden" name="grade[{!! $i !!}][{!! $cnt !!}]" value="{!! $gpa !!}"/>
                                                <?php $cnt++;?>
                                                <td class="text-center">{!! $coursesFinish[$cntCourse]->code !!}</td>
                                                <td class="text-center">{!! $coursesFinish[$cntCourse]->name !!}</td>
                                                <td class="text-center">{!! $coursesFinish[$cntCourse]->credit !!}</td>
                                                <td class="text-center">{!! $coursesFinish[$cntCourse]->prerequisite==null?'-':$coursesFinish[$cntCourse]->prerequisite !!}</td>
                                                <td class="text-center">{!! $coursesFinish[$cntCourse]->type !!}</td>
{{--                                                <td class="text-center">{!! $gpa !!}</td>--}}
                                            </tr>
                                            <?php $cntCourse++;$restCourse--; ?>
                                        @endfor
                                        </tbody>
                                    </table>
                                </div>
                            @endfor

                            @include('student.init_level.level_senior')

                            <?php //TODO change session from put to flash?>
                            {!! session()->put('coursesFinish',$coursesFinish) !!}
                            {!! session()->put('level_finish',$level_finish) !!}
                            {!! session()->put('gpa',$gpa) !!}
                            {!! session()->put('coursesNotFinish',$coursesNotFinish) !!}
                            <input type="submit" class="btn btn-success mt-2" value="Agree Plan"/>
                            <a href="{!! studentURL('plans/senior/edit/'.$id) !!}"><input type="button" class="btn btn-dark mt-2" value="Edit Plan"/></a>
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

@endsection
