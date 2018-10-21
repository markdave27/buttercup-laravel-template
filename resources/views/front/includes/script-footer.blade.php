<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="{{ asset('/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>

<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js') }}"></script>

<!-- slimScroll App -->
<script src="{{ asset('/bower_components/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>

<!-- FastClick -->
<script src="{{ asset('/bower_components/AdminLTE/plugins/fastclick/fastclick.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('/bower_components/AdminLTE/dist/js/app.min.js') }}"></script>

@yield('page-scripts')

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>