

@extends('student.index')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{!! $title !!}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{!! $title !!}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

    @include('admin.layouts.massages')

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <table class="table table-bordered" style="background: beige;">
                                        <thead>
                                        <tr>
{{--                                            <th class="text-center">Code</th>--}}
                                            <th class="text-center">Event name</th>
                                            <th class="text-center">Date</th>
                                        </tr>
                                        </thead>
                                        <tbody class="level-1">
                                            @foreach($event as $e)
                                                <tr draggable="true">
{{--                                                    <td class="text-center">{!! $e->course['code'] !!}</td>--}}
                                                    <td class="text-center">{!! $e->name !!}</td>
                                                    <td class="text-center">{!! $e->date !!}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

