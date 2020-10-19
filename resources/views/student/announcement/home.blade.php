
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
                            <table class="table table-bordered mt-3 mb-2" style="background: beige;">
                                <thead>
                                <tr>
                                    <th class="text-center">Message</th>
                                    <th class="text-center">Show</th>
                                    <th class="text-center">Is read</th>
                                </tr>
                                </thead>
                                <tbody class="level-1">
                                <?php
                                for ($i=0;$i<count($a);$i++){
                                    if ($a[$i]->isRead) $m='<button class="btn btn-success btn-sm" disabled>Yes</button>';
                                    else $m='<button class="btn btn-danger btn-sm" disabled>No</button>';
                                    ?>
                                <tr draggable="true">
                                    <td class="text-center">{!! substr($a[$i]->message,0,120) !!} {!! strlen($a[$i]->message)>120?'........':'' !!}</td>
                                    <td class="text-center">
                                        <a href="{!! studentURL('notifications/'.$a[$i]->id) !!}">
                                            <button type="button" class="btn btn-outline-primary btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </a>
                                    </td>
                                    <td class="text-center">{!! $m !!}</td>
                                </tr>
                                <?php
                                }
                                ?>

                                </tbody>
                            </table>
                            {{ $a->links() }}
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

