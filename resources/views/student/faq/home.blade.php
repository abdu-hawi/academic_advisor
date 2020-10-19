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
                        <h1>FAQ</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class=""><a href="{!! studentURL() !!}">Home</a> /</li>
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
                                            </div>
                                        </div>
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

@endsection

