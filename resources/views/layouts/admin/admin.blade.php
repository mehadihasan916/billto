<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
   <title>Dashboard | Billto.io - Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />-->
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/admin') }}/assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/admin') }}/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/admin') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/admin') }}/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />


</head>

<body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('layouts.admin.topbar')

        @include('layouts.admin.leftside_menu')



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        @yield('page_content')
        <!-- End content-page -->


        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->
    </div>

    @include('layouts.admin.footer')

    <!-- END wrapper -->


    <script>
        var resizefunc = [];
    </script>
    <script src="{{ asset('assets/admin') }}/assets/libs/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/libs/node-waves/waves.min.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/libs/apexcharts/apexcharts.min.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/js/pages/dashboard.init.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/js/app.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="{{ asset('assets/admin') }}/assets/js/pages/form-validation.init.js"></script>
    <script src="{{ asset('assets/admin/assets/js/apexcharts-light.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/admin/assets/js/dashboard.js') }}"></script>



</body>

</html>
