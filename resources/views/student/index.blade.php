@include('admin.layouts.header')
@include('student.layouts.nav')
@include('student.layouts.mainSidebar')
@include('student.layouts.controlSidebar')
@yield('content')

@include('student.chat.chat')

@include('admin.layouts.footer')
