@section('cssDataTable')
    <link rel="stylesheet" href="{!! url('/') !!}/design/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
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
                            <li><a href="{!! aurl() !!}">Dashboard</a> /</li>
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
                            <a href="{!! aurl('interests/create') !!}">
                                <button class="btn btn-success mb-2"><span class="fa fa-plus"></span> Create New Interest</button>
                            </a>
                            <table  class="table table-hover table-bordered tb-my-admin">
                                <thead>
                                <tr>
                                    <th class="text-center">Course Code</th>
                                    <th class="text-center">Course Name</th>
                                    <th class="text-center">Prerequisite</th>
                                    <th class="text-center">Interest Field</th>
                                    <th class="text-center">Edit</th>
                                    <th class="text-center">Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $colorArr = ['aliceblue','antiquewhite']; $cnt=0;?>
                                @foreach($interest as $i)
                                <tr style="background: <?php echo $colorArr[$cnt];?>;">
                                    <td class="text-center">{!! $i->f_course->code !!}</td>
                                    <td class="text-center">{!! $i->f_course->name !!}</td>
                                    <td class="text-center">{!! $i->f_course->prerequisite !!}</td>
                                    <td class="text-center col-4" rowspan="2">{!! $i->name !!}</td>
                                    <td class="text-center" rowspan="2">
                                        @include('admin.interest.btn.edit')
                                    </td>
                                    <td class="text-center" rowspan="2">
                                        @include('admin.interest.btn.delete')
                                    </td>
                                </tr>
                                <tr style="background: <?php echo $colorArr[$cnt];?>;">
                                    <td class="text-center">{!! $i->s_course->code !!}</td>
                                    <td class="text-center">{!! $i->s_course->name !!}</td>
                                    <td class="text-center">{!! $i->s_course->prerequisite !!}</td>
                                </tr>
                                <?php if ($cnt == 0) $cnt=1; else $cnt = 0; ?>
                                @endforeach
                                </tbody>
                            </table>
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

        <script src="{!! url('/') !!}/design/plugins/datatables/jquery.dataTables.js"></script>
        <script src="{!! url('/') !!}/design/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
        <script src="{!! url('/') !!}/datatable/js/dataTables.buttons.min.js"></script>
        <script src="{!! url('/') !!}/datatable/js/buttons.server-side.js"></script>

        <style>
            .table-responsive {
                width: 100% !important;
            }
            .tb-my-admin tfoot{
                display: none !important;
            }
        </style>

    @endpush

@endsection

