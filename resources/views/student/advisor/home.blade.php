

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
                            <li class="breadcrumb-item"><a href="{!! studentURL() !!}">Home</a></li>
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
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td class="col-2"><b>Name: </b></td>
                                        <td>{!! $user->name !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-2"><b>Email: </b></td>
                                        <td>{!! $user->email !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-2"><b>Phone: </b></td>
                                        <td>{!! $user->phone !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-2"><b>Room No.: </b></td>
                                        <td>{!! $user->room_no !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-2"><b>Office open from: </b></td>
                                        <td>{!! $user->office_from !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="col-2"><b>Office open to: </b></td>
                                        <td>{!! $user->office_to !!}</td>
                                    </tr>
                                    </tbody>
{{--                                    <tfoot>--}}
{{--                                    <tr>--}}
{{--                                        <td colspan="2">--}}
{{--                                            <a href="{!! advisorURL('profile/'.$user->id.'/edit') !!}"><input type="button" class="btn btn-warning" value="Edit"></a>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    </tfoot>--}}
                                </table>
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

