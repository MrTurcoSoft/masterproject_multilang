<!DOCTYPE html>
<html lang="en">

<head>
  @include('backend.inc.head')
</head>
<body>

<!-- Begin page -->
<div id="layout-wrapper">

    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">

        <div data-simplebar class="h-100">

            <div class="navbar-brand-box">
                <a href="{{route('dashboard')}}" class="logo">
                    <img src="{{asset(SiteHelpers::ayar('logo_small'))}}" />
                </a>
            </div>

            <!--- Sidemenu -->
            @include('backend.inc.sidebar')
            <!-- Sidebar -->
        </div>
    </div>
    <!-- Left Sidebar End -->

    @include('backend.inc.header')

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

       @yield('content')
        <!-- End Page-content -->

       @include('backend.inc.footer')

    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- Overlay-->
<div class="menu-overlay"></div>
@include('sweetalert::alert')

<!-- jQuery  -->
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- DataTables -->
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="{{asset('backend/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('backend/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('backend/assets/js/metismenu.min.js')}}"></script>
<script src="{{asset('backend/assets/js/waves.js')}}"></script>
<script src="{{asset('backend/assets/js/simplebar.min.js')}}"></script>

<!-- Morris Js-->
<script src="{{asset('backend/plugins/morris-js/morris.min.js')}}"></script>
<!-- Raphael Js-->
<script src="{{asset('backend/plugins/raphael/raphael.min.js')}}"></script>

<!-- Morris Custom Js-->
<script src="{{asset('backend/assets/pages/dashboard-demo.js')}}"></script>

<!-- Sweet Alerts Js-->
<script src="{{asset('backend/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

<!-- Sweet Alerts Js-->
<script src="{{asset('backend/assets/pages/sweet-alert-demo.js')}}"></script>

<!-- App js -->
<script src="{{asset('backend/assets/js/theme.js')}}"></script>



@yield('page-js')

</body>

</html>
