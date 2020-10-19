
@extends('advisor.index')

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
                            <li><a href="{!! advisorURL() !!}">Dashboard</a> /</li>
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
                            <a href="{!! advisorURL('announcements/create') !!}" class="mb-3">
                                <button class="btn btn-danger">Create Announcement</button>
                            </a>
                            <table class="table table-bordered mt-3 mb-2" style="background: beige;">
                                <thead>
                                <tr>
                                    <th class="text-center">Message</th>
                                    <th class="text-center">Student</th>
                                    <th class="text-center">Is read</th>
                                </tr>
                                </thead>
                                <tbody class="level-1">
                                <?php
                                for ($i=0;$i<count($a);$i++){
                                    if ($a[$i]->isRead) $m='<button class="btn btn-success btn-sm" disabled>Yes</button>';
                                    else $m='<button class="btn btn-danger btn-sm" disabled>No</button>';

                                    echo '
                                    <tr draggable="true">
                                        <td class="text-center">'.$a[$i]->message.'</td>
                                        <td class="text-center">'.$a[$i]->student['name'].'</td>
                                        <td class="text-center">'.$m.'</td>
                                    </tr>
                                    ';
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

