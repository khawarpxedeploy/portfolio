<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {!! SEOMeta::generate(true) !!}
    {!! OpenGraph::generate(true) !!}
    {!! Twitter::generate(true) !!}
    {!! JsonLd::generate(true) !!}
    <link rel="shortcut icon" type="image/.ico" href="{{ asset('uploads/'.tenant('user_id').'/favicon.ico') }}"/>

    <link rel="stylesheet" href="{{ asset('theme/maru/css/v4.6/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/maru/css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/maru/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/maru/css/index3.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/maru/css/hc-offcanvas-nav.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/maru/css/jquery.animatedheadline.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/maru/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/default/css/fontawesome.css') }}">
    {{ load_header() }}
</head>

<body>

    @yield('content')

    <!-- footer area start -->
    @include('theme.maru.layouts.partials.footer')
    <!-- footer area end -->
    <input type="hidden" id="base_url" value="{{ my_url() }}">

    <script src="{{ asset('backend/admin/assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('theme/maru/js/v4.6/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/maru/js/iconify.min.js') }}"></script>
    <script src="{{ asset('theme/maru/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('theme/maru/js/hc-offcanvas-nav.js') }}"></script>
    <script src="{{ asset('theme/maru/js/jquery.animatedheadline.min.js') }}"></script>
    <script src="{{ asset('theme/maru/js/script.js') }}"></script>
    @stack('js')
    <script src="{{ asset('backend/admin/assets/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('backend/admin/assets/js/form.js') }}"></script>
    {{ load_footer() }}
</body>

</html>