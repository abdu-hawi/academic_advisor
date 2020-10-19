@section('cssDataTable')
@endsection

@extends('admin.index')

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
                            <li class=""><a href="{!! aurl() !!}">Home</a> /</li>
                            <li class="active">{!! $title !!}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <a href="{!! aurl("chatter/create") !!}" class="btn btn-success m-2">Create new Answer Chatbot</a>
                    @include('admin.layouts.massages')
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">


                            <div id="accordion">

                                <?php $cntA = 1; ?>
                                @foreach ($answers as $a)
                                    <div class="faq-{{ $a->id }}">
                                        <div class="card">
                                            <div class="card-header">
                                                <a class="collapsed card-link" data-toggle="collapse" href="#collapse{!! $a->id  !!}">
                                                    <b class="text-success">Answer {!! $cntA !!}: </b>
                                                    <textarea readonly class="form-control textarea" name="answer" id="answer_{!! $a->id  !!}">{{ $a->answer }}</textarea>

                                                    <div class="pull-right mt-3">
{{--                                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg-{{ $a->id }}">Edit</button>--}}
                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#faq_delete_modal_{!! $a->id !!}">Delete</button>
                                                    </div>
                                                </a>
                                            </div>
                                            <?php $cntQ = 1; ?>
                                            @foreach($a->question as $q)
                                                <div id="collapse{!! $a->id  !!}" class="collapse" data-parent="#accordion">
                                                    <div class="card-body">
                                                        <b class="text-danger">Question {!! $cntQ !!}: </b>
                                                        <input id="question_{!! $q->id  !!}" class="form-control" value="{{ $q->question }}" readonly>
                                                    </div>
                                                </div>
                                                <?php $cntQ++; ?>
                                            @endforeach
                                            <?php $cntA++; ?>
                                        </div>
                                        <!-- model Edit -->
{{--                                        <div class="modal fade bd-example-modal-lg-{{ $a->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">--}}
{{--                                            <div class="modal-dialog modal-lg">--}}
{{--                                                <div class="modal-content">--}}
{{--                                                    <div class="modal-body">--}}
{{--                                                        <b class="text-danger">Question: </b>--}}
{{--                                                        <input id="question_m{!! $a->id  !!}" class="form-control" value="{{ $a->question }}" >--}}
{{--                                                        <b class="text-success">Answer: </b>--}}
{{--                                                        <textarea rows="5" class="form-control textarea" name="answer" id="answer_m{!! $a->id  !!}">{{ $a->answer }}</textarea>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="modal-footer">--}}
{{--                                                        <button class="btn btn-warning btn-sm {{ $a->id }}" onclick="faqEdit({{ $a->id }})">Update</button>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <!-- end modal edit -->

                                        <!-- modal delete -->
                                        <div class="modal fade" id="faq_delete_modal_{!! $a->id !!}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header bg-danger">
                                                        <h4 class="modal-title">Chatbot Answer delete</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <h5>If you delete this answer you will delete his questions</h5>
                                                        <h5>Are you sure you want delete its?</h5>
                                                    </div>
                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-outline-danger" data-dismiss="modal" onclick="faqDel({{ $a->id }})">Agree</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modal delete -->
                                    </div>
                                @endforeach
                            </div>
                            <!-- accordion -->
                            <div class="pull-right">{{ $answers->links() }}</div>

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
    @push('scripts')
        <script>
            function faqEdit(id){
                let answer = $('#answer_m'+id).val();
                let question = $('#question_m'+id).val();
                $.ajax({
                    url:"faq/"+id,
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'answer': answer,
                        'question': question,
                        '_method': $('input[name=_method]').val()
                    },
                    type:"post",
                    success:function (data) {
                        if (data === "update"){
                            $('#answer_'+id).val(answer);
                            $('#question_'+id).val(question);
                            $('.bd-example-modal-lg-'+id).modal('hide');
                            alert("Successfully update");
                        }
                    },
                    error:function (e,m) {
                        console.log('e:'+e+"||||| m:"+m);
                    }
                })
            }

            function faqDel(id) {
                $.ajax({
                    url:"chatter/"+id,
                    data: {
                        '_token': '{!! csrf_token() !!}',//$('input[name=_token]').val(),
                        '_method': "delete"
                    },
                    type:"post",
                    success:function (data) {
                        if(data === "delete"){
                            $(".faq-"+id).html("")
                            alert("Successfully delete")
                        }
                    },
                    error:function (e,m) {
                        console.log('e:'+e+"||||| m:"+m);
                    }
                })
            }
        </script>
    @endpush
@endsection

