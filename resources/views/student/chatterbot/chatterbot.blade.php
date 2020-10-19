<style>

    * {box-sizing: border-box;}

    /* Button used to open the chat form - fixed at the bottom of the page */
    .chat-button {
        color: white;
        border: none;
        cursor: pointer;
        opacity: 0.8;
        position: fixed;
        bottom: 23px;
        right: 100px;
        width:60px;
        height:60px;
        background-color:#0C9;
        border-radius:50px;
        text-align:center;
        box-shadow: 2px 2px 3px #999;
    }
    /* The popup chat - hidden by default */
    .bot-popup {
        display: none;
        position: fixed;
        bottom: 0;
        right: 15px;
        z-index: 9;
    }
    .bot-popup>.bot-msg-container{
        width: 100%;
        max-width: 600px;
        min-width: 400px;
        height: 400px;
        background: #eeeeee;
    }
    .bot-msg-container>.message-wrapper{
        background: #001e05;
    }
    .bot-messages .bot-message {
        margin-bottom: 15px;
    }
    .bot-messages .bot-message:last-child {
        margin-bottom: 205px;
    }
    .bot-received, .bot-sent {
        width: 95%;
        padding: 3px 10px;
        border-radius: 10px;
    }
    .bot-received {
        background: #e8e8e8;
        margin-left: -30px;
    }
    .bot-sent {
        background: #b2ffa9;
        float: right;
        text-align: right;
    }
    .bot-message p {
        margin: 5px 0;
    }
    .date {
        color: #777777;
        font-size: 12px;
    }
    .input-group-bot{
        position: fixed;
        bottom: 5px;
        width: -moz-available;
        margin-right: 2.5%;
    }
</style>
<button class="chat-button" onclick="openBot()">
    <img src="{!! url('/') !!}/design/dist/img/chat.png" width="40">
</button>

<div class="bot-popup" id="myBot">

    <button type="button" class="btn btn-danger btn-sm" onclick="closeBot()" style="right: 1px; top: 2px;">×</button>


    <div class="bot-msg-container" id="bot-messages">
        <div class="message-wrapper">
            <ul class="bot-messages" id="bot-msg">
{{--                <li class="bot-message clearfix">--}}
{{--                    <div class="bot-sent">--}}
{{--                        <p>sent</p>--}}
{{--                        <p class="date">20-20-222</p>--}}
{{--                    </div>--}}
{{--                </li>--}}
{{--                <li class="bot-message clearfix">--}}
{{--                    <div class="bot-received">--}}
{{--                        <p>received received received received received received received received received received received received received received received received received received</p>--}}
{{--                        <p class="date">20-20-222</p>--}}
{{--                    </div>--}}
{{--                </li>--}}
            </ul>
        </div>
    </div>

    {{--        msg to send --}}
    {{--    <form action="/action_page.php" class="form-container">--}}
    <div class="input-group input-group-bot">
        <input type="text" class="form-control submit" name="message">
        <div class="input-group-prepend">
            <button class="btn btn-default" onclick="sendBotMSG()">
                <i class="fa fa-send"></i>
            </button>
        </div>
    </div>
    {{--    </form>--}}
</div>


@push('scripts')
    <script>
        function openBot() {
            document.getElementById("myBot").style.display = "block";
        }

        function closeBot() {
            document.getElementById("myBot").style.display = "none";
        }
        $(document).on('keyup', '.input-group-bot input', function (e) {
            let message = $(this).val();
            if (e.keyCode === 13 && message !== '') {
                chatBotMsg(message)
            }
        });
        function sendBotMSG() {
            let message = $('.input-group-bot input').val();
            if (message !== '') {
                chatBotMsg(message)
            }
        }
        function chatBotMsg(msg) {
            $('#bot-msg').append(''+
                '<li class="bot-message clearfix">'+
                '<div class="bot-sent">'+
                '<p>'+msg+'</p>'+
                '</div> </li>');
            $('.input-group-bot input').val('')
            let data = "question="+msg+"&_token={!! csrf_token() !!}"
            $.ajax({
                data: data,
                url:'chatbot',
                type:'post',
                success:function (e) {
                    $('#bot-msg').append(''+
                        '<li class="bot-message clearfix">'+
                        '<div class="bot-received">'+
                        '<p>'+e+'</p>'+
                        '</div> </li>');
                    console.log(e)
                }
            })
        }
    </script>
@endpush
