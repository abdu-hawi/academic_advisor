<style>
    * {box-sizing: border-box;}

    /* Button used to open the chat form - fixed at the bottom of the page */
    .open-button {
        color: white;
        border: none;
        cursor: pointer;
        opacity: 0.8;
        position: fixed;
        bottom: 23px;
        right: 28px;
        width:60px;
        height:60px;
        background-color:#0C9;
        border-radius:50px;
        text-align:center;
        box-shadow: 2px 2px 3px #999;
    }

    /* The popup chat - hidden by default */
    .chat-popup {
        display: none;
        position: fixed;
        bottom: 0;
        right: 15px;
        /*border: 3px solid #f1f1f1;*/
        z-index: 9;
    }

    /* Add styles to the form container */
    .form-container {
        width: 300px;
        /*height: 500px;*/
        /*padding: 10px;*/
        background-color: #eeeeee;
    }


    .my-float{
        color:#FFF;
        font-size: 2rem;
    }
    .msg-container{
        width: 100%; height: 400px;
        background: #eeeeee;
    }
    li{
        list-style: none;
    }
    .message-wrapper {
        border: 1px solid #dddddd;
        overflow-y: auto;
    }
    .message-wrapper {
        padding: 10px;
        height: 536px;
        background: #eeeeee;
    }
    .messages .message {
        margin-bottom: 15px;
    }
    .messages .message:last-child {
        margin-bottom: 205px;
    }
    .received, .sent {
        width: 95%;
        padding: 3px 10px;
        border-radius: 10px;
    }
    .received {
        background: #ffffff;
        margin-left: -30px;
    }
    .sent {
        background: #3bebff;
        float: right;
        text-align: right;
    }
    .message p {
        margin: 5px 0;
    }
    .date {
        color: #777777;
        font-size: 12px;
    }
    .input-group-1{
        position: fixed;
        bottom: 5px;
        width: -moz-available;
        margin-right: 2.5%;
    }
    .pending {
        position: absolute;
        right: 3px;
        top: 0px;
        background: #d00101;
        margin: 0;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        line-height: 18px;
        padding-left: 0px;
        color: #ffffff;
        font-size: 12px;
    }
</style>

<button class="open-button" onclick="openForm()">
    <i class="fa fa-comments my-float"></i>
    <span class="pending-circle"></span>
</button>

@include('student.chatterbot.chatterbot')

<div class="chat-popup" id="myForm">

        <button type="button" class="btn btn-danger btn-sm" onclick="closeForm()" style="right: 1px; top: 2px;">×</button>


        <div class="msg-container" id="messages">
            <div class="message-wrapper">
                <ul class="messages" id="msg">

                </ul>
            </div>
        </div>

{{--        msg to send --}}
{{--    <form action="/action_page.php" class="form-container">--}}
        <div class="input-group input-group-1">
            <input type="text" class="form-control submit" name="message">
            <div class="input-group-prepend">
                <button class="btn btn-default" onclick="sendMSG()">
                    <i class="fa fa-send"></i>
                </button>
            </div>
        </div>
{{--    </form>--}}
</div>
@push('scripts')

<script>

    function openForm() {
        document.getElementById("myForm").style.display = "block";
        $('.pending-circle').html('')
        notRead = 0
        $.ajax({
            type: "get",
            url: '{!! studentURL('isRead') !!}', // need to create this route
            data: "",
            cache: false,
            success: function (data) {
            }
        });
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }
    let advisor_id = {!! student()->user()->advisor_id !!};
    let my_id = {!! student()->user()->id !!};
    let lastMsgId = 0;
    let notRead = 0;

    $(document).ready(function () {
        // get all msg
        $.ajax({
            type: "get",
            url: '{!! studentURL('messages') !!}', // need to create this route
            data: "",
            cache: false,
            success: function (data) {
                $.each(data, function( index, value ) {
                    // console.log( index + ": " + value.from );
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
                        if (value.isRead === 0) notRead++;
                        lastMsgId = value.id
                    }
                    if (notRead > 0) $('.pending-circle').html('<span class="pending">'+notRead+'</span>')
                });
                scrollToBottomFunc();
            }
        });

        // send msg
        $(document).on('keyup', '.input-group input', function (e) {

            let message = $(this).val();
            if (e.keyCode === 13 && message !== '') {
                makeMSG(message)
            }
        })

        //call from server
        setInterval(function () {
            getMsg()
        }, 1000);

    })

    function getMsg() {
        $.ajax({
            type: "get",
            url: '{!! studentURL('msg') !!}/'+lastMsgId, // need to create this route
            data: "",
            cache: false,
            success: function (data) {
                if (data.length > 0){
                    $.each(data, function( index, value ) {
                        if (value.from === advisor_id){
                            $('#msg').append(''+
                                '<li class="message clearfix">'+
                                '<div class="received">'+
                                '<p>'+value.message+'</p>'+
                                '<p class="date">'+value.created_at+'</p>'+
                                '</div> </li>');
                            lastMsgId = value.id
                            notRead++
                            $('.pending-circle').html('<span class="pending">'+(notRead)+'</span>')
                        }
                    });
                    scrollToBottomFunc();
                }

            }
        });
    }

    function sendMSG() {
        let message = $('.input-group-1 input').val();
        if (message !== '') {
            makeMSG(message)
        }
    }

    function makeMSG(message) {
        let dataStr = 'message='+message+'&_token={!! csrf_token() !!}';
        $.ajax({
            type: "post",
            url: '{!! studentURL('messages') !!}', // need to create this post route
            data: dataStr,
            cache: false,
            success: function (data) {
                $('.input-group-1 input').val('')
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

    function scrollToBottomFunc() {
        $('.message-wrapper').animate({
            scrollTop: $('.message-wrapper').get(0).scrollHeight
        }, 50);
    }


</script>
@endpush
