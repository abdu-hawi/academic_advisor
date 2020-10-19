
<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
{{--        Anything you want--}}
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019-2022 <a >Abeer.com</a></strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{!! url('/') !!}/design/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{!! url('/') !!}/design/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{!! url('/') !!}/design/dist/js/adminlte.min.js"></script>


@stack('jQuery')
@stack('scripts')

@include('admin.layouts.closeHtml')
