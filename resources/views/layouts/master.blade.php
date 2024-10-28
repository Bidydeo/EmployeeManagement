<x-app-layout>
    <!-- Site wrapper -->
    <div class="wrapper">
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                @include('layouts.navigation')
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <!-- Sidebar -->        
            @include('layouts.sidebar')
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <!-- Main content -->
                <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!--/. container-fluid -->
                </section>
                <!-- /.content -->
            </div>
        <!-- /.content-wrapper -->
</x-app-layout>