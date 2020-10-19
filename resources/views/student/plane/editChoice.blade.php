@section('cssDataTable')
@endsection

@extends('student.index')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                        <h1>
                            {!! $title !!}
                        </h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li><a href="{!! studentURL() !!}">Home</a> /</li>
                            <li><a href="{!! studentURL('plans') !!}">Plan</a> /</li>
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
                    <div id="show"></div>
                    @include('admin.layouts.massages')
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <h4 class="text-danger">Your current interest field is (<span class="text-info">{!! $interest !!}</span>) do you want to change it ?</h4>

                            <div class="raw mt-3">
                                {!! Form::open(['url'=>studentURL('plans/show/'.$id)]) !!}
                                {!! Form::submit('Continue',['class'=>'btn btn-dark']) !!}
                                {!! Form::close() !!}
                                {!! Form::button('Change',['class'=>'btn btn-danger mt-1',"data-toggle"=>"modal","data-target"=>"#modal_interest"]) !!}
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="modal_interest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Please choice new interest</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            {!! Form::open(['url'=>studentURL('plans/show/'.$id),'id'=>'form_change_interest']) !!}
                                            {!! Form::select("interest_id",App\Model\Interest::pluck("name","id"),old("interest_id"),["class"=>"form-control",'placeholder'=>'Select your interest', 'id'=>'select_change_interest']) !!}
                                            {!! Form::button('Change interest and continue',['class'=>'btn btn-info mt-1', "data-dismiss"=>"modal",'id'=>'btn_change_interest']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        <script>
            //form_change_interest
            /*
            <div class="alert alert-danger text-center card-body col-8" style="margin-left: auto;margin-right: auto;">
        <span></span>
    </div>
             */
            $(document).ready(function () {
                $('#btn_change_interest').on('click',function () {
                    if ($('#select_change_interest').val() === ""){
                        $('#show').html('<div class="alert alert-danger text-center card-body col-8" style="margin-left: auto;margin-right: auto;">\n' +
                            '<span>You are not choice any interest</span>' +
                            '</div>')
                    }else{
                        $('#form_change_interest').submit()
                    }
                })
            })
        </script>
    @endpush

@endsection

