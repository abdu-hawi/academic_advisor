
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">


    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image text-white-50">
{{--                <img src="{!! url('/') !!}/design/dist/img/admin.png" class="img-circle elevation-2" alt="User Image">--}}
                <i class="fa fa-graduation-cap" style="font-size: 2rem"></i>
            </div>
            <div class="info">
                <span class="d-block text-white-50">{!! student()->user()->name !!}</span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @include('student.layouts.menu')
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
