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
                            <div class="mb-3">
                                <div class="row block" id="mam">
                                @foreach($courses as $course)
                                    <div class="col-12 col-sm-6 col-md-3" code="{!! $course->code !!}" avg="{!! $avg[$course->code] !!}" id="{!! $course->id !!}">
                                        <div class="info-box">
                                            <div class="info-box-content">
                                                <span class="text-primary text-bold">Course Code: </span><span>{!! $course->code !!}</span><br>
                                                <span class="text-primary text-bold">Course Name: </span><span>{!! $course->name !!}</span><br>
                                                <span class="text-primary text-bold">Credit: </span><span>{!! $course->credit !!}</span><br>
                                                <span class="text-primary text-bold">Prerequisite: </span><span><?php if ( $course->code == 694) echo 'No Prerequisite but preferred to take it after all or some of Obligatory Courses'; elseif ($course->prerequisite==null) echo 'Not need'; else echo $course->prerequisite?></span><br>
                                                <span class="text-primary text-bold">Average: </span><span>{!! $avg[$course->code] !!}</span><br>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                            <style>
                                .block{
                                    cursor: move;
                                }
                            </style>
                            <b>Level 1</b>
{{--                            | <span class="text-danger mr-1">GPA:</span><span id="gpa1">0</span>--}}
                            <div class="row block mb-3" id="1" style="width: 100%; background: lightgreen; padding-top: 10px; max-height: 250px;min-height: 100px;">
                            </div>
                            <b>Level 2</b>
                            <div class="row block mb-3" id="2" style="width: 100%; background: lightgrey; padding-top: 10px; max-height: 250px;min-height: 100px;">
                            </div>
                            <b>Level 3</b>
                            <div class="row block mb-3" id="3" style="width: 100%; background: lightblue; padding-top: 10px; max-height: 250px;min-height: 100px;">
                            </div>


                            <div class="">
                                <button class="btn btn-dark" onclick="savePlane()">Save Plane</button>
                            </div>
                            {!! Form::open(['url'=>studentURL('plans/init/'.$id),'id'=>'form_add']) !!}
                            <div class="formPlan">
                                <input type="hidden" name="createByStudent" value="true" class="form-control">
                            </div>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
    function savePlane() {
        // console.log($('#1').children()[0].id)
        // console.log($('#mam').children().length)

        if ($('#mam').children().length === 0){
            for (let m = 1 ; m < 4 ; m++){
                console.log("level "+m+": "+$('#'+m).children().length)
                for (let i = 0 ; i < $('#'+m).children().length ; i++){
                    console.log("child "+i+": "+$('#'+m).children()[i].id)
                    $('.formPlan').append(
                        "<div class='mb-0'><input type='hidden' class='form-control' name='level["+m+"]["+i+"]' value='"+$('#'+m).children()[i].id+"'/> </div>");
                }
            }
            $('#form_add').submit();
        }else {
            alert('You have some course not add to your plane')
        }

    }

    $(document).ready(function () {

        var arr = [];
        let level606 = 3;
        let levelInterest = 3;

        $('.block').sortable({
            connectWith:'.block',
            receive:function (event,ui) {
                // console.log(event.target.childElementCount)
                const code = ui.item[0].attributes['code'].nodeValue; // هذا يحفظ الكود
                const id = ui.item[0].attributes['id'].nodeValue;
                const avg = ui.item[0].attributes['avg'].nodeValue;
                const level = event.target.id;
                const a = ui.sender[0].id;
                var gpa1= document.getElementById('gpa1').innerHTML
                console.log("avg: "+avg);
                console.log("a: "+a);
                // console.log("level: "+level);
                // console.log("levelInterest: "+levelInterest);
                // console.log("level606: "+level606);
                if (event.target.childElementCount > 4){
                    if (level !== 'mam'){
                        $("#"+a).sortable("cancel");
                        alert("You can't add more than 4 courses in level")
                    }
                }else if (code === '699' && level !== '3'){
                    $("#"+a).sortable("cancel");
                    alert("This is thesis course you can add just in level 3")
                }else if (code === '694' && level === '1'){
                    $("#"+a).sortable("cancel");
                    alert("This course take after all or some of Obligatory Courses")
                }else if (code === '606'){
                    level606 = level
                }else if (code === '620' ||code === '630' ||code === '640' ||code === '696' ){
                    if (level < level606){
                        $("#"+a).sortable("cancel");
                        alert("This course code: "+code+" is take after or with course code 606")
                    }else{
                        levelInterest = level
                    }
                }else if (code === '621' ||code === '631' ||code === '641' ||code === '697' ){
                    if (level <= levelInterest){
                        $("#"+a).sortable("cancel");
                        alert("This course code: "+code+" is take after course code "+(parseInt(code)-1))
                    }
                }
            }
        });

    })
</script>

    @endpush

@endsection
