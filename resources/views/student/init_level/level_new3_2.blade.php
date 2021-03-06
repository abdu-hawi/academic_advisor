<table class="table table-bordered" style="background: aliceblue;">
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
    <tbody>
    <?php $cnt = 0;?>
    @foreach($level[1][0] as $l)
        <tr>
            <input type="hidden" name="level[2][{!! $cnt !!}]" value="{!! $l->id !!}"/>
            <?php $cnt++;?>
            <td class="text-center">{!! $l->code !!}</td>
            <td class="text-center">{!! $l->name !!}</td>
            <td class="text-center">{!! $l->credit !!}</td>
            <td class="text-center">{!! $l->prerequisite==null?'-':$l->prerequisite !!}</td>
            <td class="text-center">{!! $l->type !!}</td>
            <td class="text-center">
                <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modal_{!! $l->id !!}">
                    <i class="fa fa-eye"></i>
                </button>
            </td>
        </tr>
        <div class="modal fade" id="modal_{!! $l->id !!}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header text-left bg-success">
                        Description
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body text-left">
                        <div class="m-1">
                            {!! $l->description !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endforeach

    <tr>
        <input type="hidden" name="level[2][2]" value="{!! $level[1][1]->id !!}"/>
        <td class="text-center">{!! $level[1][1]->code !!}</td>
        <td class="text-center">{!! $level[1][1]->name !!}</td>
        <td class="text-center">{!! $level[1][1]->credit !!}</td>
        <td class="text-center">{!! $level[1][1]->prerequisite==null?'-':$level[1][1]->prerequisite !!}</td>
        <td class="text-center">{!! $level[1][1]->type !!}</td>
        <td class="text-center">
            <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modal_{!! $level[1][1]->id !!}">
                <i class="fa fa-eye"></i>
            </button>
        </td>
    </tr>
    <div class="modal fade" id="modal_{!! $level[1][1]->id !!}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header text-left bg-success">
                    Description
                </div>
                <!-- Modal body -->
                <div class="modal-body text-left">
                    <div class="m-1">
                        {!! $level[1][1]->description !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
    </tbody>
</table>




