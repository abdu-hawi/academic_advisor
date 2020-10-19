<!-- Button to Open the Modal -->
<button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#show_student_{!! $id !!}">
    <i class="fa fa-eye"></i>
</button>

<!-- The Modal -->
<div class="modal fade" id="show_student_{!! $id !!}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <?php
            use App\Model\Collect\Plane;
            $plane = Plane::query()->where('student_id',$id)->with('course')->get();
            $arrOne = [];$arrTow = [];$arrThree = [];$arrFour = [];$arrFive = [];
            ?>

            @if(count($plane) > 0)
                <div class="modal-header bg-gradient-green"><h5><b>Student name:</b> {!! $name !!}</h5>
                    <a href="{!! advisorURL('plans/'.$id.'/edit/'.$name) !!}">
                        <input type="button" class="btn btn-outline-light btn-sm" value="Edit">
                    </a>
                </div>

                <!-- Modal body -->
                <div class="modal-body text-left">

                    <?php
                    for ($i=0;$i<9;$i++){
                        switch ($plane[$i]->level){
                            case 1:array_push($arrOne,$plane[$i]); break;
                            case 2:array_push($arrTow,$plane[$i]); break;
                            case 3:array_push($arrThree,$plane[$i]); break;
                            case 4:array_push($arrFour,$plane[$i]); break;
                            case 5:array_push($arrFive,$plane[$i]); break;
                        }
                    }
                    $courses = [$arrOne];
                    if (count($arrTow) > 0) array_push($courses,$arrTow);
                    if (count($arrThree) > 0) array_push($courses,$arrThree);
                    if (count($arrFour) > 0) array_push($courses,$arrFour);
                    if (count($arrFive) > 0) array_push($courses,$arrFive);
                    $bg = ['','beige','aliceblue','antiquewhite','gainsboro'];$cnt=1
                    ?>
                    @foreach($courses as $course)
                        <div class="mb-3">
                            <h5><b class="text-dark">LEVEL {!! $cnt !!}</b></h5>
                            <table class="table table-bordered" style="background: {!! $bg[$cnt] !!};">
                                <thead><?php $cnt++ ?>
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
                                    <?php $c = $course[$i]->course; ?>
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
                        </div>
                    @endforeach

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

