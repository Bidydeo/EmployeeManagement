<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'NEO') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/plugins/fontawesome-free/css/all.min.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="/plugins/fullcalendar/main.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/adminlte.min.css">
    <!-- Upload Image & preview -->
    <link rel="stylesheet" href="/dist/css/upload-image-style.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    {{-- <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed"> --}}
    <div class="wrapper">
        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div> --}}
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 0.01 alpha
        </div>
        <strong>Copyright &copy; 2022 <a href="https://neotechnik.ro">Neotechnik.ro</a>.</strong> All rights reserved.
    </footer>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge("uibutton", $.ui.button);
    </script>
    <!-- Bootstrap -->
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/adminlte.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="/plugins/raphael/raphael.min.js"></script>
    <script src="/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <!-- ChartJS -->
    <script src="/plugins/chart.js/Chart.min.js"></script>
    <!-- fullCalendar 2.2.5 -->
    <script src="/plugins/moment/moment.min.js"></script>
    <script src="/plugins/fullcalendar/main.js"></script>
    <script src="/dist/js/pages/connectedSortable.js"></script>
    <!-- Upload Image & preview -->
    <script src="/dist/js/upload-image-style.js"></script>
    <script src="/dist/js/company-project-employee-handler.js"></script>
</body>

</html>
