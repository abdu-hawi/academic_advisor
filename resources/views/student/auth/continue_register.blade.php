<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{!! !empty($title)?$title:'Advisor Academic' !!}@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{!! url('/') !!}/design/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{!! url('/') !!}/design/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{!! url('/') !!}/design/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- multi select bootstrap plugin -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />


    <style>
        .login-page, .register-page {
            -ms-flex-align: center;
            align-items: center;
            background: #f1fdec;
            display: -ms-flexbox;
            display: flex;
            height: 100vh;
            -ms-flex-pack: center;
            justify-content: center;
        }

    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box col-4">
    <div class="login-logo">
        <img src="{!! url('/') !!}/design/dist/img/KAU_logo.png" width="200" height="200">
    </div>
    <!-- /.login-logo -->
    <div class="card">
        @include('admin.auth.layouts.massages')
        <div class="card-body login-card-body">
{{--            @include('admin.auth.layouts.massages')--}}

            <form action="{!! studentURL('register/'.$id) !!}" method="post">
                {!! csrf_field() !!}

                <p class="mb-0">Are you:</p>
                <input type="radio" id="new_student" name="type" value="new_student" checked onclick="newS()">
                <label for="new_student">New Student</label><br>
                <input type="radio" id="senior_student" name="type" value="senior_student" onclick="senior()">
                <label for="senior_student">Senior Student</label><br>

                <div id="add_senior"></div>

                <div class="row">
                    <!-- /.col -->
                    <div class="col-6 mb-2">
                        <button type="submit" class="btn btn-success btn-block">Generate Plane</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{!! url('/') !!}/design/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{!! url('/') !!}/design/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{!! url('/') !!}/design/dist/js/adminlte.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

<script>
    function newS() {
        document.getElementById("add_senior").innerHTML = "";
    }

    function senior() {
        let s = '<label class="mb-0">GPA:</label>';
        s += '<div class="input-group mb-1">';
        s += '<input type="number" step="0.01" min="3.5" max="5" name="gpa" class="form-control @error("gpa") is-invalid @enderror" placeholder="GPA" value="{!! old("gpa")?old("gpa"):3.5 !!}" required>';
        s += '@error("gpa")';
        s += '<span class="invalid-feedback" role="alert">';
        s += '<strong>{{ $message }}</strong>';
        s += '</span>';
        s += '@enderror';
        s += '</div>';
        s += '<label class="mb-0">Level Finish:</label>';
        s += '<div class="input-group mb-1">';
        s += '<input type="number" min="1" max="6" name="level_finish" class="form-control @error("level_finish") is-invalid @enderror"';
        s += ' placeholder="Finished Level" value="{!! old("level_finish")?old("level_finish"):1 !!}" required>';
        s += '@error("level_finish")';
        s += '<span class="invalid-feedback" role="alert">';
        s += '<strong>{{ $message }}</strong>';
        s += '</span>';
        s += '@enderror';
        s += '</div>';
        s += '<input type="hidden" name="course_finish" id="course_finish" value="{!! old("course_finish") !!}">';
        s += '<label class="mb-0">Your Interest:</label>';
        s += '<div class="input-group mb-1">';
        s += '{!! Form::select("interest_id",App\Model\Interest::pluck("name","id"),old("interest_id"),["class"=>"form-control",'placeholder'=>'Select your interest', 'id'=>'interest']) !!}';
        s += '</div>';
        s += '<label class="mb-0">Finished Course:</label>';
        s += '<div class="input-group mb-1">';
        s += '{!! Form::select("course",App\Model\Course::select(DB::raw('CONCAT(code, " - ", name) AS full_name, id'))
                    ->pluck('full_name', 'id'),old("course"),["class"=>"form-control","id"=>"framework", "multiple"]) !!}';
        s += '</div>';
        document.getElementById("add_senior").innerHTML = s;

        $('#framework').multiselect({
            nonSelectedText: 'Select finished courses',
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            maxHeight: '1000',
            buttonWidth: '400',
            onChange: function(element, checked) {
                var brands = $('#framework option:selected');
                var selected = [];
                $(brands).each(function(index, brand){
                    selected.push([$(this).val()]);
                });
                $('#course_finish').val(selected);
            }
        });
    }



</script>

</body>
</html>
