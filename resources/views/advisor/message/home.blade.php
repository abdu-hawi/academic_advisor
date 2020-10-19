

@extends('advisor.index')

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
                            <li class="breadcrumb-item"><a href="{!! advisorURL() !!}">Home</a></li>
                            <li class="breadcrumb-item active">{!! $title !!}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

    @include('admin.layouts.massages')

        <style>
            .card .nav.flex-column > li.msg-active {
                border-bottom: 1px solid rgba(0,0,0,.125);
                margin: 0;
                background: #001e05;
            }
            .card .nav.flex-column > li:not(.msg-active):hover {
                background: #001e05;
                opacity: 0.7;
            }
            .nav-pills .nav-link {
                color: #70a279;
            }
            /*.nav-pills .nav-link:not(.active) {*/
            /*    color: #001e05;*/
            /*}*/

            .nav-pills .nav-link:not(.msg-active):hover {
                color: #70a279;
            }

            .card .nav.flex-column > li.msg-active.nav-link {
                color: #70a279;
            }

            .msg-active {
                color: #eceff4;
            }

            .div-row{
                height: 450px;
                background: #edffe1;
            }
            .div-card{
                overflow-y:auto ;
                height: 450px;
            }

            .div-msg{
                overflow-y:auto ;
                background: #ffffff;
                height: 375px;
                margin: -20px -20px 0;
            }


            .messages .message {
                margin-bottom: 15px;
            }
            .messages .message:last-child {
                margin-bottom: 0;
            }
            .received, .sent {
                width: 95%;
                padding: 3px 10px;
                border-radius: 10px;
            }
            .received {
                background: rgb(194, 199, 208);
                margin-left: -30px;
            }
            .sent {
                background: #70a279;;
                float: right;
                text-align: right;
                margin-right: 10px;
            }
            .message p {
                margin: 5px 0;
            }
            .date {
                color: #777777;
                font-size: 12px;
            }
            li{
                list-style-type: none;
            }
        </style>
    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row  div-row">
                    <div class="col-lg-3 ">
                        <div class="card div-card">
                            <div class="card-body p-0">
                                <ul class="nav nav-pills flex-column student">                                    @foreach($students as $student)
                                        <li class="nav-item student-li" id="{!! $student->id !!}">
                                            <a class="nav-link">
                                                {!! $student->name !!}
                                                <span id="student_{!! $student->id !!}">

                                                </span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>
                    <!-- /.col-md-6 -->
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="div-msg">
                                    <ul class="messages" id="msg">

                                    </ul>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="input-group">
                                    <input type="text" class="form-control submit" name="message">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-default" onclick="sendMSG()">
                                            <i class="fa fa-send"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@push('scripts')
<script>
    let lastMsgId = 0;
    let student_id = 0;

    $(document).ready(function () {
        // get all msg unread
        $.ajax({
            type: "get",
            url: '{!! advisorURL('msg_unread') !!}', // need to create this route
            data: "",
            cache: false,
            success: function (data) {
                $.each(data, function( index, value ){
                    let sel = $('#student_'+value.from);
                    if (sel.children().length > 0){
                        sel.children()[0].firstChild.data = parseInt(sel.children()[0].firstChild.data) + 1;
                    }else{
                        sel.html('<span class="badge bg-danger float-right">1</span>')
                    }
                    lastMsgId = parseInt(value.id)
                    scrollToBottomFunc();
                })
            }
        });

        // user active and change number unread
        $('.student-li').click(function () {
            $('.student-li').removeClass('msg-active');
            $(this).addClass('msg-active');
            student_id = parseInt($(this).attr('id'));
            let sel = $('#student_'+student_id);
            getStudentMsg(student_id);
            let numUnread = 0;
            let numBadgeMsg = 0;
            let msgBadgeMsg = $('#msg-badge-container');
            if (sel.children().length > 0){
                numUnread = parseInt(sel.children()[0].firstChild.data)
            }
            sel.html('');
            if (msgBadgeMsg.children().length > 0){
                numBadgeMsg = parseInt(msgBadgeMsg.children()[0].firstChild.data) - numUnread
                if (numBadgeMsg > 999){
                    msgBadgeMsg.html('<span class="badge bg-danger float-right badge-msg">...</span>')
                }else if (numBadgeMsg < 1){
                    msgBadgeMsg.html('')
                }else{
                    msgBadgeMsg.html('<span class="badge bg-danger float-right badge-msg">'+numBadgeMsg+'</span>')
                }
            }
            isRead(student_id)
        });

        // send msg
        $(document).on('keyup', '.input-group input', function (e) {
            let message = $(this).val();
            if (e.keyCode === 13 && message !== '') {
                makeMSG(message)
            }
        })

        setInterval(function () {
            getMsg()
        }, 1000);

    }); // end document ready

    // get msg by interval
    function getMsg() {
        $.ajax({
            type: "get",
            url: '{!! advisorURL('msg') !!}/'+lastMsgId, // need to create this route
            data: "",
            cache: false,
            success: function (data) {
                if (data.length > 0){
                    let numBadgeMsg = 0;
                    let msgBadgeMsg = $('#msg-badge-container');

                    $.each(data, function( index, value ) {
                        if (!value.isRead){
                            if (parseInt(value.from) !== parseInt(student_id)) {
                                let sel = $('#student_'+value.from);
                                if (sel.children().length > 0){
                                    let numMsg = parseInt(sel.children()[0].firstChild.data)
                                    sel.children()[0].firstChild.data = numMsg + 1;
                                }else{
                                    sel.html('<span class="badge bg-danger float-right">1</span>')
                                }
                                if (msgBadgeMsg.children().length > 0){
                                    numBadgeMsg = parseInt(msgBadgeMsg.children()[0].firstChild.data)
                                    numBadgeMsg++
                                    if (numBadgeMsg > 999) {
                                        msgBadgeMsg.html('<span class="badge bg-danger float-right badge-msg">...</span>')
                                    }else
                                        msgBadgeMsg.html('<span class="badge bg-danger float-right badge-msg">'+numBadgeMsg+'</span>')
                                }else{
                                    msgBadgeMsg.html('<span class="badge bg-danger float-right badge-msg">1</span>')
                                }
                            }else{
                                $('#msg').append(''+
                                    '<li class="message clearfix">'+
                                    '<div class="received">'+
                                    '<p>'+value.message+'</p>'+
                                    '<p class="date">'+value.created_at+'</p>'+
                                    '</div> </li>');
                                isRead(parseInt(value.from))
                            }
                        }
                        scrollToBottomFunc();
                        lastMsgId = value.id
                    })
                }
            }
        });
    }

    function sendMSG() {
        let message = $('.input-group input').val();
        if (message !== '') {
            makeMSG(message)
        }
    }

    function makeMSG(message) {
        let dataStr = 'message='+message+'&_token={!! csrf_token() !!}';
        $.ajax({
            type: "post",
            url: '{!! advisorURL('messages') !!}/'+student_id, // need to create this post route
            data: dataStr,
            cache: false,
            success: function (data) {
                $('.input-group input').val('')
                $('#msg').append(''+
                    '<li class="message clearfix">'+
                    '<div class="sent">'+
                    '<p>'+message+'</p>'+
                    '<p class="date">'+data.created_at+'</p>'+
                    '</div> </li>');
            },
            error: function (jqXHR, status, err) {
            },
            complete: function () {
                scrollToBottomFunc();
            }
        })
    }

    function getStudentMsg(id) {
        let my_id = {!! advisor()->user()->id !!}
        $.ajax({
            type: "get",
            url: '{!! advisorURL('get_all_msg_student') !!}/'+id, // need to create this route
            data: "",
            cache: false,
            success: function (data) {
                $('#msg').html('');
                $.each(data, function( index, value ) {
                    if (value.from === my_id){
                        $('#msg').append(''+
                            '<li class="message clearfix">'+
                            '<div class="sent">'+
                            '<p>'+value.message+'</p>'+
                            '<p class="date">'+value.created_at+'</p>'+
                            '</div> </li>');
                    }else{
                        $('#msg').append(''+
                            '<li class="message clearfix">'+
                            '<div class="received">'+
                            '<p>'+value.message+'</p>'+
                            '<p class="date">'+value.created_at+'</p>'+
                            '</div> </li>');
                        lastMsgId = parseInt(value.id)
                    }
                });
                scrollToBottomFunc();
            }
        });
    }

    function isRead(id) {
        $.ajax({
            type: "get",
            url: '{!! advisorURL('isRead') !!}/'+id,
            cache: false
        });
    }

    function scrollToBottomFunc() {
        $('.div-msg').animate({
            scrollTop: $('.div-msg').get(0).scrollHeight //* 1000
        },50);
    }
</script>
@endpush
