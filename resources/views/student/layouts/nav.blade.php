<body class="hold-transition sidebar-mini">
<div class="wrapper">
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    @if(student()->user()->has_plane != 0)
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link announcement" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right drop-announcement">

                </div>
            </li>
        </ul>
    @endif
        <!-- Log out -->
        <li class="nav-item">
            <a class="nav-link" href="{!! studentURL('logout') !!}" alt="Logout">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
@push('jQuery')
        <script>
            $(document).ready(function () {
                getNotification()
                function getNotification() {
                    $.ajax({
                        type: "get",
                        url: '{!! studentURL('notifications') !!}', // need to create this route
                        data: "",
                        cache: false,
                        success: function (data) {
                            console.log(data.total)
                            let announcement = $('.announcement');
                            let drop = $('.drop-announcement');
                            if (data.total > 99){
                                announcement.append('<span class="badge badge-danger navbar-badge">...</span>')
                                drop.append('<span class="dropdown-item dropdown-header">'+data.total+' Notifications</span>')
                            }else if (data.total < 1){
                                announcement.html('<i class="far fa-bell"></i>')
                                drop.append('<span class="dropdown-item dropdown-header">No Notifications</span>')
                            } else{
                                announcement.append('<span class="badge badge-danger navbar-badge">'+data.total+'</span>')
                                drop.append('<span class="dropdown-item dropdown-header">'+data.total+' Notifications</span>')
                            }
                            for (let i=0;i<data.data.length;i++){
                                if (parseInt(data.data[i].isRead) === 1)
                                    drop.append('<div class="dropdown-divider"></div>' +
                                        '<a href="{!! studentURL("notifications") !!}/'+data.data[i].id+'" class="dropdown-item">'
                                        + (data.data[i].message).substr(0, 35) + ' ...' +
                                        '</a>');
                                else
                                    drop.append('<div class="dropdown-divider"></div>' +
                                        '<a href="{!! studentURL("notifications") !!}/'+data.data[i].id+'" class="dropdown-item"><b>'
                                        +(data.data[i].message).substr(0,35)+' ...'+
                                        '</b></a>');

                            }
                            drop.append('<div class="dropdown-divider"></div>' +
                                '<a href="{!! studentURL("notifications") !!}" class="dropdown-item dropdown-footer">See All Notifications</a>');
                        }
                    });
                }
                setInterval(function () {
                    getNotification()
                }, 60000);
            })
        </script>
@endpush
