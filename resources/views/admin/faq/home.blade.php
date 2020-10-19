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
                        <h1>FAQ</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class=""><a href="{!! aurl() !!}">Home</a> /</li>
                            <li class="active">FAQ</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <a href="{!! aurl("faq/create") !!}" class="btn btn-success m-2">Create new FAQ</a>
                    @include('admin.layouts.massages')
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">


                            <div id="accordion">

                                @foreach ($faqs as $faq)
                                    <div class="faq-{{ $faq->id }}">
                                        <div class="card">
                                            <div class="card-header">
                                                <a class="collapsed card-link" data-toggle="collapse" href="#collapse{!! $faq->id  !!}">
                                                    <b class="text-danger">Question: </b>
                                                    <input id="question_{!! $faq->id  !!}" class="form-control" value="{{ $faq->question }}" readonly>
                                                </a>
                                            </div>
                                            <div id="collapse{!! $faq->id  !!}" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <b class="text-success">Answer: </b>
                                                    <textarea readonly class="form-control textarea" name="answer" id="answer_{!! $faq->id  !!}">{{ $faq->answer }}</textarea>
                                                    <input type="hidden" name="_method" value="PUT">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                </div>
                                                <div class="card-footer">
                                                    <div class="pull-right">
                                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg-{{ $faq->id }}">Edit</button>
                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#faq_delete_modal_{!! $faq->id !!}">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- model Edit -->
                                        <div class="modal fade bd-example-modal-lg-{{ $faq->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <b class="text-danger">Question: </b>
                                                        <input id="question_m{!! $faq->id  !!}" class="form-control" value="{{ $faq->question }}" >
                                                        <b class="text-success">Answer: </b>
                                                        <textarea rows="5" class="form-control textarea" name="answer" id="answer_m{!! $faq->id  !!}">{{ $faq->answer }}</textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-warning btn-sm {{ $faq->id }}" onclick="faqEdit({{ $faq->id }})">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modal edit -->

                                        <!-- modal delete -->
                                        <div class="modal fade" id="faq_delete_modal_{!! $faq->id !!}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header bg-danger">
                                                        <h4 class="modal-title">FAQ delete</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <h5>Are you sure you want delete this faq?</h5>
                                                    </div>
                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-outline-danger" data-dismiss="modal" onclick="faqDel({{ $faq->id }})">Agree</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modal delete -->
                                    </div>
                                @endforeach
                            </div>
                            <!-- accordion -->
                            <div class="pull-right">{{ $faqs->links() }}</div>

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
                url:"faq/"+id,
                data: {
                    '_token': $('input[name=_token]').val(),
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

