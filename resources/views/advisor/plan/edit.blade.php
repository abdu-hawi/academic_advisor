@section('cssDataTable')
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
                        <h3>
                            <a href="{!! advisorURL('students/'.$id) !!}">
                                <button class="btn btn-outline-dark btn-sm">
                                    <i class="fa fa-arrow-left"></i>
                                </button>
                            </a>
                            {!! $title !!} of <b>{!! $name !!}</b>
                        </h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li><a href="{!! advisorURL() !!}">Dashboard</a> /</li>
                            <li><a href="{!! advisorURL('students') !!}">Students</a> /</li>
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
                    <style>
                        .block{
                            cursor: move;
                        }
                    </style>
                    @include('admin.layouts.massages')
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php
                            $bg = ['','beige','aliceblue','antiquewhite','gainsboro','beige','aliceblue','antiquewhite','gainsboro'];$cnt=1
                            ?>
                                <div id="card_level">
                                    @foreach($courses as $course)
                                        <div class="mb-3 {!! $cnt !!}">
                                            <h5><b class="text-dark">LEVEL {!! $cnt !!}</b></h5>
                                            <table class="table table-bordered" id="{!! $cnt !!}" style="background: {!! $bg[$cnt] !!};">
                                                <thead><?php $cnt++ ?>
                                                <tr>
                                                    <th class="text-center col-1">Code</th>
                                                    <th class="text-center col-6">Course name</th>
                                                    <th class="text-center col-1">Credit</th>
                                                    <th class="text-center col-2">Prerequisite</th>
                                                    <th class="text-center col-1">Type</th>
{{--                                                    <th class="text-center col-1">Grade</th>--}}
                                                </tr>
                                                </thead>
                                                <tbody class="sortable">
                                                @for($i=0;$i<count($course);$i++)
                                                    <?php $c = $course[$i]->course; ?>
                                                    <tr id="{!! $c->id !!}" code="{!! $c->code !!}" grade="{!! $course[$i]->grade !!}">
                                                        <td class="text-center">{!! $c->code !!}</td>
                                                        <td class="text-center">{!! $c->name !!}</td>
                                                        <td class="text-center">{!! $c->credit !!}</td>
                                                        <td class="text-center"><?php if ( $c->code == 694) echo 'No Prerequisite but preferred to take it after all or some of Obligatory Courses'; elseif ($c->prerequisite==null) echo '-'; else echo $c->prerequisite?></td>
                                                        <td class="text-center">{!! $c->type !!}</td>
{{--                                                        <td class="text-center">{!! $course[$i]->grade !!}</td>--}}
                                                    </tr>
                                                @endfor
                                                </tbody>
                                            </table>
                                        </div>
                                    @endforeach
                                </div>
                                <button class="btn btn-dark" onclick="addLevel()">Add Level</button>
                                <button class="btn btn-primary ml-2" onclick="saveP()">SAVE PLAN</button>
                        </div>
                        {!! Form::open(['url'=>advisorURL('plans/'.$id),'method'=>'put','id'=>'form_edit']) !!}
                        <div class="editFormPlan">

                        </div>
                        {!! Form::close() !!}
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script>
            function addLevel() {
                let html_code = '<div class="mb-3 {!! $cnt !!}">\n' +
                    '<h5><b class="text-dark">LEVEL {!! $cnt !!}</b></h5>\n' +
                    '<table class="table table-bordered sortable" id="{!! $cnt !!}" style="background: {!! $bg[$cnt] !!};">\n' +
                    '<thead><?php $cnt++ ?>\n' +
                    '<tr>\n' +
                    '<th class="text-center col-1">Code</th>\n' +
                    '<th class="text-center col-6">Course name</th>\n' +
                    '<th class="text-center col-1">Credit</th>\n' +
                    '<th class="text-center col-2">Prerequisite</th>\n' +
                    '<th class="text-center col-1">Type</th>\n' +
                    '<th class="text-center col-1">Grade</th>\n' +
                    '</tr>\n' +
                    '</thead>\n' +
                    '<tbody class="sortable">'+
                    '</tbody>\n' +
                    '</table>\n' +
                    '</div>';
                $('#card_level').append(html_code)
                $( ".sortable" ).sortable({connectWith:'.sortable'});
                $( ".sortable" ).disableSelection();
            }
            function saveP() {
                let is606,isInterest = false;
                let level = 0;
                $('.editFormPlan').html("");
                for (let c=0;c<{!! $cnt !!};c++) {
                    for (let i=0;i<$('#'+c).children().length;i++){ // هذا يعمل تكرار بداخل الجدول لمعرفة كم تي بودي بداخله
                        // console.log($('#1').children()[i])
                        if ($('#'+c).children()[i].classList.contains('sortable')){ // هذا يتأكد هل هو رأس جدول والا محتوى الجدول
                            // console.log($('#'+c).children()[i].children[0].id)
                            // console.log($('#'+c).children()[i].childElementCount)
                            if ($('#'+c).children()[i].childElementCount > 0){ // اذا الجدول بداخله صفوف
                                for (let t=0;t<$('#'+c).children()[i].childElementCount;t++){
                                    // console.log('Level '+c+'---------------------')
                                    // console.log('Row '+t+' id: '+$('#'+c).children()[i].children[t].getAttribute('id'))
                                    // console.log('Row '+t+' code: '+$('#'+c).children()[i].children[t].getAttribute('code'))
                                    if ($('#'+c).children()[i].children[t].getAttribute('code') === '606') {
                                        is606 = true
                                    }
                                    if ($('#'+c).children()[i].children[t].getAttribute('code') === '620' ||
                                        $('#'+c).children()[i].children[t].getAttribute('code') === '630' ||
                                        $('#'+c).children()[i].children[t].getAttribute('code') === '640' ||
                                        $('#'+c).children()[i].children[t].getAttribute('code') === '696') {
                                        if (!is606){
                                            alert('The course code '+$('#'+c).children()[i].children[t].getAttribute('code')+' is take after course code 606');
                                            return;
                                        }else{
                                            isInterest = true
                                        }
                                    }
                                    if ($('#'+c).children()[i].children[t].getAttribute('code') === '621' ||
                                        $('#'+c).children()[i].children[t].getAttribute('code') === '631' ||
                                        $('#'+c).children()[i].children[t].getAttribute('code') === '641' ||
                                        $('#'+c).children()[i].children[t].getAttribute('code') === '697') {
                                        if (!isInterest){
                                            alert('The course code '+$('#'+c).children()[i].children[t].getAttribute('code')+' is take after course code '+($('#'+c).children()[i].children[t].getAttribute('code')-1));
                                            return;
                                        }
                                    }
                                    $('.editFormPlan').append(
                                        "<input type='hidden' name='level["+level+"]["+t+"]' value='"+$('#'+c).children()[i].children[t].getAttribute('id')+"'/>" +
                                        "<input type='hidden' name='grade["+level+"]["+t+"]' value='"+$('#'+c).children()[i].children[t].getAttribute('grade')+"'/>");
                                }
                            }
                            if ($('#' + c).children()[i].children.length !== 0) {
                                level++;
                            }
                        }
                    }
                }
                if (isInterest && is606){
                    alert()
                    $('#form_edit').submit()
                }else alert('You have some error')
            }

            $(document).ready(function () {
                $( ".sortable" ).sortable({connectWith:'.sortable'});
                $( ".sortable" ).disableSelection();
            })
        </script>

    @endpush

@endsection

