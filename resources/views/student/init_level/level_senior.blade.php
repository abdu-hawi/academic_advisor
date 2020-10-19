<?php
$levelCNF = $level_finish+1;
$tableCNF = ceil(count($coursesNotFinish)/$num_course);
$tableRC = ceil(count($coursesNotFinish)%$num_course);
$cntCNF = count($coursesNotFinish);
$levelInterest1 = 0;
$cntO=0;
$addTableForThesis = false;
$levelForInterestTowAndThesis = [];
$levelGpa = [];
?>
@for($x=0;$x<$tableCNF;$x++)
    <?php
        $levelGpa[$x] = 0 ;
        $countCourseInLevelForGPA = 0;
    ?>
    @if(count($coursesNotFinish)>0 && !$addTableForThesis)
        <div class="mb-3">
            <h6><b class="text-dark">Level {!! $levelCNF !!}</b> | <b class="text-red ml-2">GPA: </b><span id="levelGpa{!! $x !!}"></span></h6>
        </div>
        <table class="table table-bordered" style="background: beige;">
            <thead>
            <tr>
                <th class="text-center">Course code</th>
                <th class="text-center">Course name</th>
                <th class="text-center">Credit</th>
                <th class="text-center">Prerequisite</th>
                <th class="text-center">type</th>
                <th class="text-center">Description</th>
            </tr>
            </thead>
            <tbody class="level-1">
            <?php
            $cntNumRow = $num_course;
            $l1=0;
            $l2=0;
            $cnt = 0;
            ?>
            @if(!$is606)
                <?php
                $levelGpa[$x] += $gpaAvg[$coursesNotFinish[$x]->code];
                $countCourseInLevelForGPA ++;
                ?>
                <tr>
                    <input type="hidden" name="level[{!! $levelCNF !!}][{!! $cnt !!}]" value="{!! $coursesNotFinish[$x]->id !!}"/>
                    <?php $cnt++;?>
                    <td class="text-center">{!! $coursesNotFinish[$x]->code !!}</td>
                    <td class="text-center">{!! $coursesNotFinish[$x]->name !!}</td>
                    <td class="text-center">{!! $coursesNotFinish[$x]->credit !!}</td>
                    <td class="text-center">{!! $coursesNotFinish[$x]->prerequisite==null?'-':$coursesNotFinish[$x]->prerequisite !!}</td>
                    <td class="text-center">{!! $coursesNotFinish[$x]->type !!}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modal_{!! $coursesNotFinish[$x]->id !!}">
                            <i class="fa fa-eye"></i>
                        </button>
                    </td>
                </tr>

                <?php
                $cntNumRow--;
                $cntCNF--;
                array_splice($coursesNotFinish,0,1);
                $is606 = true;
                ?>
            @endif

            @if(!$isInterest)
                <?php
                foreach ($coursesNotFinish as $cnf){
                if ($cnf->code == 620 || $cnf->code == 630 || $cnf->code == 640 || $cnf->code == 696) {
                    $levelGpa[$x] += $gpaAvg[$cnf->code];
                $countCourseInLevelForGPA++;
                ?>

                <tr draggable="true">
                    <input type="hidden" name="level[{!! $levelCNF !!}][{!! $cnt !!}]" value="{!! $cnf->id !!}"/>
                    <?php $cnt++;?>
                    <td class="text-center">{!! $cnf->code !!}</td>
                    <td class="text-center">{!! $cnf->name !!}</td>
                    <td class="text-center">{!! $cnf->credit !!}</td>
                    <td class="text-center">{!! $cnf->prerequisite==null?'-':$cnf->prerequisite !!}</td>
                    <td class="text-center">{!! $cnf->type !!}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modal_{!! $cnf->id !!}">
                            <i class="fa fa-eye"></i>
                        </button>
                    </td>
                </tr>

                <?php
                }
                }
                $cntCNF--;
                $cntNumRow--;
                array_splice($coursesNotFinish,0,1);
                $isInterest = true;
                $levelInterest1 = $levelCNF;
                ?>
            @endif
            <?php
            if ($cntCNF<$cntNumRow) $cntNumRow = $cntCNF;
            ?>
            @for($m=1;$m<=$cntNumRow;$m++)
                <?php
                if ($coursesNotFinish[$cntO]->code == '621' ||
                $coursesNotFinish[$cntO]->code == '631' ||
                $coursesNotFinish[$cntO]->code == '641' ||
                $coursesNotFinish[$cntO]->code == '697'  ){
                if ($levelInterest1 != $levelCNF){
                    $levelGpa[$x] += $gpaAvg[$coursesNotFinish[$cntO]->code];
                $countCourseInLevelForGPA++;
                ?>
                <tr draggable="true">
                    <input type="hidden" name="level[{!! $levelCNF !!}][{!! $cnt !!}]" value="{!! $coursesNotFinish[$cntO]->id !!}"/>
                    <?php $cnt++;?>
                    <td class="text-center">{!! $coursesNotFinish[$cntO]->code !!}</td>
                    <td class="text-center">{!! $coursesNotFinish[$cntO]->name !!}</td>
                    <td class="text-center">{!! $coursesNotFinish[$cntO]->credit !!}</td>
                    <td class="text-center">{!! $coursesNotFinish[$cntO]->prerequisite==null?'-':$coursesNotFinish[$cntO]->prerequisite !!}</td>
                    <td class="text-center">{!! $coursesNotFinish[$cntO]->type !!}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modal_{!! $coursesNotFinish[$cntO]->id !!}">
                            <i class="fa fa-eye"></i>
                        </button>
                    </td>
                </tr>
                <?php
                }else{
                    $addTableForThesis = true;
                    $levelForInterestTowAndThesis = [];
                    array_push($levelForInterestTowAndThesis,$coursesNotFinish[$cntO]);
                }
                }else{
                if ($coursesNotFinish[$cntO]->code == '699' && $addTableForThesis){
                    array_push($levelForInterestTowAndThesis,$coursesNotFinish[$cntO]);
                }else{
                $levelGpa[$x] += $gpaAvg[$coursesNotFinish[$cntO]->code];
                $countCourseInLevelForGPA++;
                ?>
                <tr draggable="true">
                    <input type="hidden" name="level[{!! $levelCNF !!}][{!! $cnt !!}]" value="{!! $coursesNotFinish[$cntO]->id !!}"/>
                    <?php $cnt++;?>
                    <td class="text-center">{!! $coursesNotFinish[$cntO]->code !!}</td>
                    <td class="text-center">{!! $coursesNotFinish[$cntO]->name !!}</td>
                    <td class="text-center">{!! $coursesNotFinish[$cntO]->credit !!}</td>
                    <td class="text-center">{!! $coursesNotFinish[$cntO]->prerequisite==null?'-':$coursesNotFinish[$cntO]->prerequisite !!}</td>
                    <td class="text-center">{!! $coursesNotFinish[$cntO]->type !!}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modal_{!! $coursesNotFinish[$cntO]->id !!}">
                            <i class="fa fa-eye"></i>
                        </button>
                    </td>
                </tr>
                <?php
                }
                }
                $cntCNF--;$cntO++;?>
            @endfor
            </tbody>
        </table>
        <?php $levelCNF++; ?>
    @elseif(count($coursesNotFinish)>0 && $addTableForThesis)
        <?php
        array_push($levelForInterestTowAndThesis,$coursesNotFinish[$cntO]);
        ?>
    @endif
    <?php
    $levelGpa[$x] = round($levelGpa[$x]/$countCourseInLevelForGPA,2);
    ?>
    <script>
        document.getElementById("levelGpa{!! $x !!}").innerHTML = <?php echo $levelGpa[$x]; ?>;
    </script>
@endfor

@if($addTableForThesis)
    <?php $ll = $levelCNF; ?>
    <div class="mb-3">
        <h6><b class="text-dark">Level {!! $ll !!}</b> | <b class="text-red ml-2">GPA: </b>0</h6>
    </div>
    <table class="table table-bordered" style="background: beige;">
        <thead>
        <tr>
            <th class="text-center">Course code</th>
            <th class="text-center">Course name</th>
            <th class="text-center">Credit</th>
            <th class="text-center">Prerequisite</th>
            <th class="text-center">type</th>
            <th class="text-center">Description</th>
        </tr>
        </thead>
        <tbody class="level-1">
        @for($i=0;$i<count($levelForInterestTowAndThesis);$i++)
            <tr>
                <input type="hidden" name="level[{!! $ll !!}][{!! $i !!}]" value="{!! $levelForInterestTowAndThesis[$i]->id !!}"/>
                <td class="text-center">{!! $levelForInterestTowAndThesis[$i]->code !!}</td>
                <td class="text-center">{!! $levelForInterestTowAndThesis[$i]->name !!}</td>
                <td class="text-center">{!! $levelForInterestTowAndThesis[$i]->credit !!}</td>
                <td class="text-center">{!! $levelForInterestTowAndThesis[$i]->prerequisite==null?'-':$levelForInterestTowAndThesis[$i]->prerequisite !!}</td>
                <td class="text-center">{!! $levelForInterestTowAndThesis[$i]->type !!}</td>
                <td class="text-center">
                    <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modal_{!! $levelForInterestTowAndThesis[$i]->id !!}">
                        <i class="fa fa-eye"></i>
                    </button>
                </td>
            </tr>
        @endfor
        </tbody>
    </table>
@endif

<?php
$allLevel = count($levelGpa) + $level_finish;
$countGpaForLevelFinish = $gpa * $level_finish;
$countFullGpa = $countGpaForLevelFinish;
foreach ($levelGpa as $level_gpa){
    $countFullGpa += $level_gpa;
}
?>

<hr>
<h5><b class="text-red mr-2">GPA:</b>{!! round($countFullGpa/$allLevel,2) !!}</h5>
