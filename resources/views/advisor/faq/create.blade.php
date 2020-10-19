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
                        <h1>New FAQ</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class=""><a href="{!! advisorURL() !!}">Home</a> /</li>
                            <li class="active">New FAQ</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">

                            <form action="{!! advisorURL("faq") !!}" method="post">
                                {!! csrf_field() !!}
                                <div class="text-danger">Question: </div>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control  @error('question') is-invalid @enderror"
                                           name="question" value="{!! old('question') !!}">
                                    @error('question')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="text-success">Answer: </div>
                                <div class="input-group mb-3">
                                <textarea type="text" class="form-control  @error('answer') is-invalid @enderror"
                                          name="answer">
                                    {!! old('answer') !!}
                                </textarea>
                                    @error('answer')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <input type="submit" class="btn btn-success" value="Save">
                            </form>

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

