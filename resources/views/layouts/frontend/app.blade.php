<!doctype html>
<html class="no-js" lang="bn">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="description"
        content="Billto is an online invoice generator and accounting software – an innovative business tool you can use for creating invoices online without any hassle. It allows businesses to produce invoices using a ready-made template, where all that needs to be done is inserting the client’s details, the items for payment, taxes (if necessary), and the total amount – then sending the invoice to the client online.">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:title" content="@yield('title')">
    <meta property="og:type" content="">
    <meta property="og:description"
        content="Billto is an online invoice generator and accounting software – an innovative business tool you can use for creating invoices online without any hassle. It allows businesses to produce invoices using a ready-made template, where all that needs to be done is inserting the client’s details, the items for payment, taxes (if necessary), and the total amount – then sending the invoice to the client online.">
    <meta property="og:url" content="https://billto.io">
    <meta property="og:image" content="{{ asset('assets/frontend/img/thumbnail/banner.png') }}">
    <meta name="theme-color" content="#fafafa">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="{{ asset('icon.png') }}">
    <!-- Bootstrap icons v1.7.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    {{-- datepicker css --}}
    <link rel="stylesheet" href="{{ asset('css/date-ui-css/datepicker-ui.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.3/css/flag-icon.min.css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/normalize.css') }}">
    <!-- Bootstrap v5.1.3  -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    @stack('frontend_css')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/main.css') }}">


    @if (Config::get('languages')[App::getLocale()]['flag-icon'] == 'bd')
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/fonts_bangla.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/fonts_english.css') }}">
    @endif


</head>

<body id="body_alert">

    <!-- Header Start -->
    @include('layouts.frontend.partial.header')
    <!-- Header End -->
    @yield('frontend_content')

    <!-- Footer Start -->
    @include('layouts.frontend.partial.footer')
    <!-- Footer End -->

    <script src="{{ asset('assets/frontend/js/vendor/modernizr-3.11.2.min.js') }}"></script>
    <script src="{{ asset('assets/frontend/js/plugins.js') }}"></script>

    <!-- Bootstrap v5.1.3 -->
    <script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>

    <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
    <script>
        window.ga = function() {
            ga.q.push(arguments)
        };
        ga.q = [];
        ga.l = +new Date;
        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('set', 'anonymizeIp', true);
        ga('set', 'transport', 'beacon');
        ga('send', 'pageview')
    </script>
    <script src="https://www.google-analytics.com/analytics.js" async></script>
    @stack('frontend_js')

    {{-- date picker --}}
    <script src="{{ asset('js/datepicker-ui-js/jquery-ui-cdn.js') }}"></script>
    <script>
        $(function() {
            $("#invoice_date").datepicker();
        });

        $(function() {
            $("#invoice_dou_date").datepicker();
        });
        $(function() {
            $("#date_id").datepicker();
        });
    </script>

    {{-- alert message show  --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <script src="sweetalert2.min.js"></script>

    @if (session()->has('success'))
        <style>
            .colored-toast {
                background-color: #ffffff !important;
            }

            .colored-toast {
                color: rgb(93, 187, 97);
                font-size: 15px;
            }
        </style>

        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                customClass: {
                    popup: 'colored-toast'
                },
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'success',
                title: '{{ session()->get('success') }}',
            })
        </script>
    @endif
    @if (session()->has('delete'))
        <style>
            .colored-toast {
                background-color: #ffffff !important;
            }

            .colored-toast {
                color: rgb(250, 6, 6);
                font-size: 15px;
            }
        </style>
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                customClass: {
                    popup: 'colored-toast'
                },
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon: 'warning',
                title: '{{ session()->get('delete') }}',
            })
        </script>
    @endif
    <script src="{{ asset('assets/frontend/js/main.js') }}"></script>
</body>

</html>
