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
                        <h1>New Chatbot</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class=""><a href="{!! advisorURL() !!}">Home</a> /</li>
                            <li class="active">New Chatbot</li>
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
                            <h3><span class="text-danger">Note: </span>write down all the expected questions for this answer</h3>
                            <form action="{!! advisorURL("chatter") !!}" method="post" id="form">
                                {!! csrf_field() !!}

                                <label class="text-success" for="answer">Answer: </label>
                                <div class="input-group mb-3">
                                    <textarea type="text" id="answer" class="form-control  @error('answer') is-invalid @enderror"
                                              name="answer">{!! trim(old('answer')) !!}</textarea>
                                    @error('answer')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="add-row">
                                    <div class="text-danger">Question 1: </div>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control  @error("question[0]") is-invalid @enderror"
                                               name="question[0]" id="question_1" value="{!! old("question[0]") !!}">
                                        @error("question[0]")
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </form>

                            <div class="raw">
                                <div class="col-1 mr-auto ml-auto">
                                    <button class="btn btn-success btn-sm" onclick="addQuestion()"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <input type="submit" id="submit" class="btn btn-success" value="Save">

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

        let cnt = 1;
        let q = $('#question_'+cnt);
        function addQuestion() {
            if ($.trim(q.val()).length < 1){
                q.addClass('is-invalid')
                alert('Please write question inside input')
            }else{
                q.removeClass('is-invalid')
                let html_code = '';
                cnt++;
                html_code +='<div class="text-danger">Question '+cnt+': </div>';
                html_code +='<div class="input-group mb-3">';
                html_code +='<input type="text" class="form-control" name="question['+cnt+']" id="question_'+cnt+'" value="{!! old("question[!!}'+cnt+'{!! ]") !!}">';
                html_code +='</div>';
                $('.add-row').append(html_code)
            }
        }

        $(document).ready(function () {
            $('#submit').on('click',function () {
                let answer = $('#answer');
                if ($.trim(answer.val()).length > 0){
                    $('#form').submit();
                }else {
                    answer.addClass('is-invalid')
                    alert("You can't add without answer")
                }
            })
        })


    </script>
    @endpush
@endsection

