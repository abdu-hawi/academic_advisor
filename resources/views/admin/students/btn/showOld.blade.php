<!-- Button to Open the Modal -->
<button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#show_student_{!! $id !!}">
    <i class="fa fa-eye"></i>
</button>

<!-- The Modal -->
<div class="modal fade" id="show_student_{!! $id !!}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <?php
            use App\Model\Collect\Plane;use Illuminate\Support\Facades\DB;
            $plane = Plane::query()->where('student_id',$id)->with('course')->get();
            $arrOne = [];$arrTow = [];$arrThree = [];$arrFour = [];$arrFive = [];$arrSix = [];$arrSeven = [];
            ?>

            @if(count($plane) > 0)
                <div class="modal-header bg-gradient-green"><h5><b>Student name:</b> {!! $name !!}</h5>
                    <a href="{!! aurl('plans/'.$id.'/edit/'.$name) !!}">
                        <input type="button" class="btn btn-outline-light btn-sm" value="Edit">
                    </a>
                </div>

                <!-- Modal body -->
                <div class="modal-body text-left">

                    <?php
                    for ($i=0;$i<10;$i++){
                        switch ($plane[$i]->level){
                            case 1:array_push($arrOne,$plane[$i]); break;
                            case 2:array_push($arrTow,$plane[$i]); break;
                            case 3:array_push($arrThree,$plane[$i]); break;
                            case 4:array_push($arrFour,$plane[$i]); break;
                            case 5:array_push($arrFive,$plane[$i]); break;
                            case 6:array_push($arrSix,$plane[$i]); break;
                            case 7:array_push($arrSeven,$plane[$i]); break;
                        }
                    }
                    $courses = [$arrOne];
                    if (count($arrTow) > 0) array_push($courses,$arrTow);
                    if (count($arrThree) > 0) array_push($courses,$arrThree);
                    if (count($arrFour) > 0) array_push($courses,$arrFour);
                    if (count($arrFive) > 0) array_push($courses,$arrFive);
                    if (count($arrSix) > 0) array_push($courses,$arrSix);
                    if (count($arrSeven) > 0) array_push($courses,$arrSeven);
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
                        <h5><b class="text-dark">GPA:</b><span class="ml-1 text-danger" id="full_gpa"></span> </h5>
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
                                    <th class="text-center">Grade</th>
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
                                        <td class="text-center col-1">{!! $c->code !!}</td>
                                        <td class="text-center col-6">{!! $c->name !!}</td>
                                        <td class="text-center col-1">{!! $c->credit !!}</td>
                                        <td class="text-center col-2"><?php if ( $c->code == 694) echo 'No Prerequisite but preferred to take it after all or some of Obligatory Courses'; elseif ($c->prerequisite==null) echo '-'; else echo $c->prerequisite?></td>
                                        <td class="text-center col-1">{!! $c->type !!}</td>
                                        <td class="text-center col-1">{!! $course[$i]->grade !!}</td>
                                    </tr>
                                </tbody>
                                @endfor
                            </table>
                        </div><?php
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
            @else
                    <div class="modal-header bg-gradient-danger"><h5><b>Student name:</b> {!! $name !!}</h5>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body text-left">
                        <h3>This Student don't has plan</h3>
                    </div>
            @endif

        </div>
    </div>
</div>

