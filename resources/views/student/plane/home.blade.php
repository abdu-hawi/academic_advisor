

@extends('student.index')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{!! $title !!}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{!! $title !!}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

    @include('admin.layouts.massages')

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                use Illuminate\Support\Facades\DB;
                                $bg = ['','beige','aliceblue','antiquewhite','gainsboro','beige','aliceblue','antiquewhite','gainsboro'];
                                $cnt=1;
                                $scores = DB::table('scores')
                                    ->select('course_id',DB::raw('round(AVG(score),2) as score'))
                                    ->groupBy('course_id')
                                    ->get();
                                $score = [];
                                foreach ($scores as $s){
                                    $score[$s->course_id] = $s->score;
                                }
                                $fullGpa = 0;
                                ?>
                                    <h5><b class="text-dark">This is the predicted GPA that you may get 'you can get better it's not sure' :</b><span class="ml-1 text-danger" id="full_gpa"></span> </h5>
                                    <hr>
                                @foreach($courses as $course)
                                    <?php
                                        $cntCourseInLevel = 0;
                                        $cntGpaInLevel = 0;
                                        $levelGpa = 0;
                                    ?>
                                        <div class="mb-3">
                                            <h6><b class="text-dark">LEVEL {!! $cnt !!}</b> | <span class="text-danger">GPA:</span><span class="ml-1" id="gpaLevel_{!! $cnt !!}"></span></h6>
                                            <table class="table table-bordered" style="background: {!! $bg[$cnt] !!};">
                                                <thead>
                                                <tr>
                                                    <th class="text-center">Code</th>
                                                    <th class="text-center">Course name</th>
                                                    <th class="text-center">Credit</th>
                                                    <th class="text-center">Prerequisite</th>
                                                    <th class="text-center">Type</th>
                                                    <th class="text-center col-1">Details</th>
                                                </tr>
                                                </thead>
                                                <tbody class="level-1">
                                                @for($i=0;$i<count($course);$i++)
                                                    <?php
                                                    $c = $course[$i]->course;
                                                    $cntCourseInLevel++;
                                                    if ($course[$i]->grade > 0) {
                                                        $cntGpaInLevel += $course[$i]->grade;
                                                    }else{
                                                        $cntGpaInLevel += $score[$course[$i]->course_id];
                                                    }
                                                    ?>
                                                    <tr draggable="true">
                                                        <td class="text-center">{!! $c->code !!}</td>
                                                        <td class="text-center">{!! $c->name !!}</td>
                                                        <td class="text-center">{!! $c->credit !!}</td>
                                                        <td class="text-center"><?php if ( $c->code == 694) echo 'No Prerequisite but preferred to take it after all or some of Obligatory Courses'; elseif ($c->prerequisite==null) echo '-'; else echo $c->prerequisite?></td>
                                                        <td class="text-center">{!! $c->type !!}</td>
                                                        <td class="text-center">
                                                            <button class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#show_{!! $c->id !!}">
                                                                <i class="fa fa-eye"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="show_{!! $c->id !!}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    {!! $c->description !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endfor
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php
                                        $levelGpa = round($cntGpaInLevel/$cntCourseInLevel,2);
                                        $fullGpa += $levelGpa;
                                        ?>
                                        <script>
                                            document.getElementById("gpaLevel_{!! $cnt !!}").innerHTML = <?php echo $levelGpa; ?>;
                                        </script>
                                    <?php $cnt++; ?>
                                @endforeach
                                    <script>
                                        document.getElementById("full_gpa").innerHTML = <?php echo round($fullGpa / ($cnt - 1),2) ?>;
                                    </script>
                            </div>
                            <div class="card-footer">
                                <a href="{!! studentURL('plans/edit/id/') !!}/{!! student()->user()->id !!}"><button class="btn btn-outline-dark"><i class="fa fa-edit"></i> Edit plan</button> </a>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

