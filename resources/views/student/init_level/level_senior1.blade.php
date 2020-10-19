<?php $levelCNF = $level_finish+1 ?>
<div class="mb-3">
    <h5><b class="text-dark">Level {!! $levelCNF !!}</b></h5>
</div>
<?php
    $tableCNF = ceil(count($coursesNotFinish)/$num_course);
    $tableRC = ceil(count($coursesNotFinish)%$num_course);
    $cntCNF = count($coursesNotFinish);

?>

tableCNF: {!! $tableCNF !!}<br>
$coursesNotFinish: {!! count($coursesNotFinish) !!}<br>
$num_course: {!! $num_course !!}<br>
$tableRC: {!! $tableRC !!}<br>
{{--{!! dd($coursesNotFinish) !!}--}}
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
@for($x=0;$x<=$tableCNF;$x++)
    <?php
    $cntNumRow = $num_course;
    $l1=0;
    $l2=0;
    $cnt = 0;
    ?>
    @if(!$is606)
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
            unset($coursesNotFinish[0]);
        ?>
    @endif

    @if(!$isInterest)
        <?php
            foreach ($coursesNotFinish as $cnf){
                    if ($cnf->code == 620 || $cnf->code == 630 || $cnf->code == 640 || $cnf->code == 696) {
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
        ?>


        <?php
        $cntCNF--;
        $cntNumRow--;
        unset($coursesNotFinish[0]);
        ?>
    @endif
    <?php
        if ($cntCNF<$cntNumRow) $cntNumRow = $cntCNF;
    ?>
    @for($m=1;$m<=$cntNumRow;$m++)
        <tr draggable="true">
            <input type="hidden" name="level[{!! $levelCNF !!}][{!! $cnt !!}]" value="{!! $coursesNotFinish[$m]->id !!}"/>
            <?php $cnt++;?>
            <td class="text-center">{!! $coursesNotFinish[$m]->code !!}</td>
            <td class="text-center">{!! $coursesNotFinish[$m]->name !!}</td>
            <td class="text-center">{!! $coursesNotFinish[$m]->credit !!}</td>
            <td class="text-center">{!! $coursesNotFinish[$m]->prerequisite==null?'-':$coursesNotFinish[$m]->prerequisite !!}</td>
            <td class="text-center">{!! $coursesNotFinish[$m]->type !!}</td>
            <td class="text-center">
                <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modal_{!! $coursesNotFinish[$m]->id !!}">
                    <i class="fa fa-eye"></i>
                </button>
            </td>
        </tr>
        <?php $cntCNF--?>
    @endfor
@endfor

    </tbody>
</table>


