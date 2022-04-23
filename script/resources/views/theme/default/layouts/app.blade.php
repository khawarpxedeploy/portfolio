<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('uploads/'.tenant('user_id').'/favicon.ico') }}"/>

    {!! SEOMeta::generate(true) !!}
    {!! OpenGraph::generate(true) !!}
    {!! Twitter::generate(true) !!}
    {!! JsonLd::generate(true) !!}
    <!-- css here -->
    <link rel="stylesheet" href="{{ asset('theme/default/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/default/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/default/css/hc-offcanvas-nav.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/default/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/default/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/default/css/jquery.animatedheadline.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/default/css/fontawesome.css') }}"/>
    <input type="hidden" id="url" value="{{ my_url() }}">
    {{ load_header() }}
</head>
<body>
 
    <!-- header area start -->
    
    <!-- header area end -->

    <!-- main area start -->
    @yield('content')
    <!-- main area end -->

    <!-- footer area start -->
    
    <!-- footer area end -->
     <input type="hidden" id="base_url" value="{{ my_url() }}">
    <!-- js here -->
    <script src="{{ asset('theme/default/js/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/default/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/default/js/iconify.min.js') }}"></script>
    <script src="{{ asset('theme/default/js/hc-offcanvas-nav.js') }}"></script>
    <script src="{{ asset('theme/default/js/jquery.animatedheadline.min.js') }}"></script>
    <script src="{{ asset('theme/default/js/script.js') }}"></script>
    @stack('js')
    <script src="{{ asset('backend/admin/assets/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('backend/admin/assets/js/form.js') }}"></script>
     {{ load_footer() }}
    </body>
</html>