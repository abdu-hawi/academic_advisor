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
                            {!! $dataTable->table(['class'=>'table table-hover table-bordered table-striped tb-my-admin'],true) !!}
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

        {!! $dataTable->scripts() !!}

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

