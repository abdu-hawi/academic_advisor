<?php
$courseInLevel = ceil(count($coursesFinish)/$levelFinish); // 6/2=3 |
$cntCourse=0;
$cntCourseLoop=0;
$restCourse = count($coursesFinish);
$countCourse=0;
$i=1;
$bg = ['','beige','aliceblue','seashell','antiquewhite','gainsboro'];
$is606 = 4;
$isInterest = 4;
?>
<script>
    var level606 = 4;
    var levelInterest = 4;
</script>
@for(;$i<=$levelFinish;$i++)
    <div class="mb-3">
        <h5><b class="text-dark">LEVEL{!! $i !!}</b></h5>
        <table class="table table-bordered" style="background: {!! $bg[$i] !!};">
            <thead>
            <tr>
                <th class="text-center">Course code</th>
                <th class="text-center">Course name</th>
                <th class="text-center">Credit</th>
                <th class="text-center">Prerequisite</th>
                <th class="text-center">type</th>
                <th class="text-center">GPA</th>
            </tr>
            </thead>
            <tbody class="level-1">
            <?php
            $cnt = 0;
            if ($i==$levelFinish && $restCourse > 0){
                $countCourse = $restCourse;
            }else{
                $countCourse = $courseInLevel;
            }
            ?>
            <div id="{!! $i !!}" style="display: none">
                @for($m=1;$m<=$countCourse;$m++)
                    <div class="mr-1" code="{!! $coursesFinish[$cntCourseLoop]->code !!}" data-gpa="{!! $gpa !!}" id="{!! $coursesFinish[$cntCourseLoop]->id !!}"></div>
                    <?php $cntCourseLoop++?>
                @endfor
            </div>
            @for($m=1;$m<=$countCourse;$m++)
                <?php
                if ($coursesFinish[$cntCourse]->code == 606) {
                    $is606 = $i;
                    echo '<script>level606 = '.$i.'</script>';
                }
                if ($coursesFinish[$cntCourse]->code == 620 ||
                    $coursesFinish[$cntCourse]->code == 630 ||
                    $coursesFinish[$cntCourse]->code == 640 ||
                    $coursesFinish[$cntCourse]->code == 696  ) {
                    $isInterest = $i;
                    echo '<script>levelInterest = '.$i.'</script>';
                }
                ?>

                <tr>
                    <?php $cnt++;?>
                    <td class="text-center">{!! $coursesFinish[$cntCourse]->code !!}</td>
                    <td class="text-center">{!! $coursesFinish[$cntCourse]->name !!}</td>
                    {{--                                                <td class="text-center">{!! $coursesFinish[$cntCourse]->credit !!}</td>--}}
                    <td class="text-center">{!! $coursesFinish[$cntCourse]->credit !!}</td>
                    <td class="text-center">{!! $coursesFinish[$cntCourse]->prerequisite==null?'-':$coursesFinish[$cntCourse]->prerequisite !!}</td>
                    <td class="text-center">{!! $coursesFinish[$cntCourse]->type !!}</td>
                    <td class="text-center">{!! $gpa !!}</td>
                </tr>
                <?php $cntCourse++;$restCourse--?>
            @endfor
            </div>
            </tbody>
        </table>
    </div>
@endfor

