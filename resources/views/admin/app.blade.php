<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.includes.header')
    @yield('p_css')
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        @include('admin.includes.sidebar')
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                @include('admin.includes.menu')
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                @yield('admin.content')
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    @include('admin.includes.footer')
    @include('admin.includes.alerts')
    @yield('admin.page-scripts')
    @yield('p_js')



    @if (session()->has('alert_message'))
    <div class="modal fade" id="alert-message-modal" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center alert alert-{{ session()->get('alert_message')['icon'] }}">
                        {{ session()->get('alert_message')['message'] }}
                    </div>
                    {{ session()->forget('alert_message') }}
                </div>
            </div>
        </div>
    </div>
    @endif



    <script>
        $("#alert-message-modal").modal('show');
    </script>
    @yield('scripts')
</body>

</html>