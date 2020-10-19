<li class="nav-item">
    <a href="{!! aurl('') !!}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{!! aurl('advisors') !!}" class="nav-link {!! active_menu('advisors')[0] !!}">
        <i class="nav-icon fas fa-user-cog"></i>
        <p>
            Advisors
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{!! aurl('students') !!}" class="nav-link {!! active_menu('students')[0] !!}">
        <i class="nav-icon fas fa-user-graduate"></i>
        <p>
            Students
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{!! aurl('links') !!}" class="nav-link {!! active_menu('link')[0] !!}">
        <i class="nav-icon fas fa-link"></i>
        <p>
            Links
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{!! aurl('courses') !!}" class="nav-link {!! active_menu('courses')[0] !!}">
        <i class="nav-icon fas fa-laptop-code"></i>
        <p>
            Courses
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{!! aurl('interests') !!}" class="nav-link {!! active_menu('interests')[0] !!}">
        <i class="nav-icon fas fa-icons"></i>
        <p>
            Interests
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{!! aurl('exams') !!}" class="nav-link {!! active_menu('exams')[0] !!}">
        {{--        <i class="nav-icon fas fa-superscript"></i>--}}
        <i class="nav-icon fa fa-calendar-alt"></i>
        <p>
            Events
        </p>
    </a>
</li>

{{--<li class="nav-item">--}}
{{--    <a href="{!! aurl('advisors') !!}" class="nav-link {!! active_menu('advisors')[0] !!}">--}}
{{--        <i class="nav-icon fas fa-chalkboard-teacher"></i>--}}
{{--        <p>--}}
{{--            Advisors--}}
{{--        </p>--}}
{{--    </a>--}}
{{--</li>--}}

<li class="nav-item">
    <a href="{!! aurl('faq') !!}" class="nav-link {!! active_menu('faq')[0] !!}">
        <i class="nav-icon fas fa-question-circle"></i>
        <p>
            FAQ
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{!! aurl('chatter') !!}" class="nav-link {!! active_menu('chatter')[0] !!}">
        <i class="nav-icon fas fa-robot"></i>
        <p>
            ChatBot
        </p>
    </a>
</li>
