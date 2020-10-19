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

@if(student()->user()->has_plane != 0)
    <li class="nav-item">
        <a href="{!! studentURL('plans') !!}" class="nav-link {!! active_menu('plans')[0] !!}">
            <i class="nav-icon fas fa-tasks"></i>
            <p>
                Plan
            </p>
        </a>
    </li>
@endif

<li class="nav-item">
    <a href="{!! studentURL('links') !!}" class="nav-link {!! active_menu('links')[0] !!}">
        <i class="nav-icon fas fa-link"></i>
        <p>
            Quick links
        </p>
    </a>
</li>

@if(student()->user()->has_plane != 0)
<li class="nav-item">
    <a href="{!! studentURL('advisor') !!}" class="nav-link {!! active_menu('advisor')[0] !!}">
        <i class="nav-icon fas fa-chalkboard-teacher"></i>
        <p>
            Advisor
        </p>
    </a>
</li>



<li class="nav-item">
    <a href="{!! studentURL('notifications') !!}" class="nav-link {!! active_menu('announcements')[0] !!}">
        <i class="nav-icon fas fa-bell"></i>
        <p>
            Notifications
        </p>
    </a>
</li>

<li class="nav-item has-treeview {!! active_menu('exams')[1] !!}">
    <a href="#" class="nav-link {!! active_menu('exams')[0] !!}">
        <i class="nav-icon fas fa-calendar-alt"></i>
        <p>
            Coming Events
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item ml-3">
            <a href="{!! studentURL('exams') !!}" class="nav-link {!! active_menu('exams')[0] !!}">
                <i class="fas fa-circle nav-icon text-green"></i>
                <p>
                    Events
                </p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="{!! studentURL('faq') !!}" class="nav-link {!! active_menu('faq')[0] !!}">
        <i class="nav-icon fas fa-question-circle"></i>
        <p>
            FAQ
        </p>
    </a>
</li>
@endif
<li class="nav-item">
    <a href="{!! studentURL('profile') !!}" class="nav-link {!! active_menu('profile')[0] !!}">
        <i class="nav-icon fas fa-cog"></i>
        <p>
            Profile
        </p>
    </a>
</li>
