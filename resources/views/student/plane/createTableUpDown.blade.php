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
                            <style>
                                #m-ul{
                                    list-style-type: none;
                                    display: table;
                                    overflow: scroll;
                                    padding: 10px 3px 3px;
                                }
                                #m-ul > li {
                                    display: table-cell;
                                    border: #0b2e13 1px solid;
                                }
                            </style>
                            <div class="mb-3" > <!--style=" height: 200px; overflow: scroll"-->

                                <table id="table" class="table table-bordered" style="background: beige;">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Course code</th>
                                        <th class="text-center">Course name</th>
                                        <th class="text-center">Credit</th>
                                        <th class="text-center">Prerequisite</th>
                                        <th class="text-center">Description</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $cnt = 0; $level = 1; ?>
                                    @foreach($courses as $course)
                                        @if($cnt == 0 || $cnt == 3 || $cnt == 6|| $cnt == 9)
                                            <th class="bg-gradient-dark" colspan="5">
                                                Level {!! $level !!}
                                            </th>
                                            <?php $level++; ?>
                                        @endif
                                        <tr draggable="true">
                                            <input type="hidden" name="level[4][0]" value="{!! $course->id !!}"/>
                                            <td class="text-center">{!! $course->code !!}</td>
                                            <td class="text-center">{!! $course->name !!}</td>
                                            <td class="text-center">{!! $course->credit !!}</td>
                                            <td class="text-center">{!! $course->credit !!}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php $cnt++;?>
                                    @endforeach
                                    </tbody>
                                </table>

                                <button onclick="upNDown('up')">&ShortUpArrow;</button>
                                <button onclick="upNDown('down')">&ShortDownArrow;</button>
                            </div>
                        </div>
                        <style>
                            .selected{
                                background: #1d2124; color: whitesmoke; font-weight: bold;
                            }
                        </style>
                        <script>
                            let index;
                            function selectRow() {
                                let table = document.getElementById('table');
                                for (let i = 0 ; i < table.rows.length ; i++){
                                    table.rows[i].onclick = function () {
                                        if(typeof index !== 'undefined'){
                                            table.rows[index].classList.toggle("selected");
                                        }
                                        index = this.rowIndex;
                                        this.classList.toggle("selected");
                                    }
                                }
                            }selectRow();
                            function upNDown(direction) {
                                let row = document.getElementById("table").rows,
                                    parent = row[index].parentNode;
                                if(direction === "up"){
                                    if(index > 1){
                                        parent.insertBefore(row[index],row[index-1]);
                                        index--;
                                    }
                                }else if(direction === "down"){
                                    if(index < row.length-1){
                                        parent.insertBefore(row[index+1],row[index]);
                                        index++;
                                    }
                                }
                            }
                        </script>
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

{{--        <script src="{!! url('/') !!}/design/plugins/datatables/jquery.dataTables.js"></script>--}}
{{--        <script src="{!! url('/') !!}/design/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>--}}
{{--        <script src="{!! url('/') !!}/datatable/js/dataTables.buttons.min.js"></script>--}}
{{--        <script src="{!! url('/') !!}/datatable/js/buttons.server-side.js"></script>--}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>



    @endpush

@endsection
