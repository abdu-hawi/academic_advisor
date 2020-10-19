<style>
    [class*="sidebar-dark-"] {
        background-color: #001e05;
    }
    .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active, .sidebar-light-primary .nav-sidebar > .nav-item > .nav-link.active {
        background-color: #70a279;
        color: #fff;
    }
    body {
        margin: 0;
        font-family: "Source Sans Pro",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        text-align: left;
        background-color: #000d02;
    }
    .content-wrapper {
        background: #f1fdec;
    }
    a{
        color: #28a745;
    }
    a:hover {
        color: #176824;
        text-decoration: none;
    }
</style>

<li class="nav-item">
    <a href="{!! advisorURL('students') !!}" class="nav-link {!! active_menu('students')[0] !!}">
        <i class="nav-icon fas fa-user-graduate"></i>
        <p>
            Students
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{!! advisorURL('links') !!}" class="nav-link {!! active_menu('links')[0] !!}">
        <i class="nav-icon fas fa-link"></i>
        <p>
            Quick links
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{!! advisorURL('messages') !!}" class="nav-link {!! active_menu('messages')[0] !!}">
        <i class="nav-icon far fa-comments"></i>
        <p>
            Messages
        </p>
        <span id="msg-badge-container"></span>
    </a>
</li>

<li class="nav-item">
    <a href="{!! advisorURL('exams') !!}" class="nav-link {!! active_menu('exams')[0] !!}">
{{--        <i class="nav-icon fas fa-superscript"></i>--}}
        <i class="nav-icon fa fa-calendar-alt"></i>
        <p>
            Events
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{!! advisorURL('announcements') !!}" class="nav-link {!! active_menu('announcements')[0] !!}">
        <i class="nav-icon fas fa-bullhorn"></i>
        <p>
            Announcements
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{!! advisorURL('faq') !!}" class="nav-link {!! active_menu('faq')[0] !!}">
        <i class="nav-icon fas fa-question-circle"></i>
        <p>
            FAQ
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{!! advisorURL('chatter') !!}" class="nav-link {!! active_menu('chatter')[0] !!}">
        <i class="nav-icon fas fa-robot"></i>
        <p>
            ChatBot
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{!! advisorURL('profile') !!}" class="nav-link {!! active_menu('profile')[0] !!}">
        <i class="nav-icon fas fa-cog"></i>
        <p>
            Profile
        </p>
    </a>
</li>


@push('scripts')
<script>
    $.ajax({
        type: "get",
        url: '{!! advisorURL('msg_unread') !!}', // need to create this route
        data: "",
        cache: false,//<span class="badge bg-danger float-right badge-msg">1</span>
        success: function (data) {
            console.log(data.length)
            if (data.length > 999){
                $('#msg-badge-container').html('<span class="badge bg-danger float-right badge-msg">...</span>')
            }else if (data.length < 1){
                $('#msg-badge-container').html('')
            }else{
                $('#msg-badge-container').html('<span class="badge bg-danger float-right badge-msg">'+data.length+'</span>')
            }
        }
    });
</script>
@endpush
