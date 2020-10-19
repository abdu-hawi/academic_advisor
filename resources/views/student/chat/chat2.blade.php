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
        border: 3px solid #f1f1f1;
        z-index: 9;
    }

    /* Add styles to the form container */
    .form-container {
        width: 300px;
        height: 500px;
        padding: 10px;
        background-color: white;
    }


    .my-float{
        color:#FFF;
        font-size: 2rem;
    }
    .msg-container{
        width: 100%; height: 400px; background: lightblue; overflow-y: scroll;
    }
</style>

<button class="open-button" onclick="openForm()"><i class="fa fa-comments my-float"></i></button>

<div class="chat-popup" id="myForm">
        <button type="button" class="btn btn-danger btn-sm" onclick="closeForm()" style="right: 1px; top: 2px;">×</button>
        <div class="mt-1 msg-container">
            <ul>
                <li>hi</li>
                <li>hi</li>
                <li>hi</li>
                <li>hi</li>
                <li>hi</li>
                <li>hi</li>
                <li>hi</li>
                <li>hi</li>
                <li>hi</li>
                <li>hi</li>
                <li>hi</li>
                <li>hi</li>
                <li>hi</li>
                <li>hi</li>
                <li>hi</li>
                <li>hi</li>
                <li>hi</li>
                <li>hi</li>
                <li>hi</li>
                <li>hi</li>
                <li>hi</li>
                <li>hi</li>
            </ul>
        </div>

{{--        msg to send --}}
    <form action="/action_page.php" class="form-container">
        <div class="input-group" style="position: fixed;bottom: 5px;width: auto">
            <input type="text" class="form-control">
            <div class="input-group-prepend">
                <button class="btn btn-default">
                    <i class="fa fa-send"></i>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }
</script>
