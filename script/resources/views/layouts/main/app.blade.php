<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}
    {!! JsonLdMulti::generate() !!}
    {!! SEO::generate(true) !!}

   
    <link rel="stylesheet" href="{{ asset('main/assets/css/bootstrap.min.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('main/assets/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('main/assets/css/hc-offcanvas-nav.css') }}">
    <link rel="stylesheet" href="{{ asset('main/assets/css/owl.carousel.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('main/assets/css/responsive.css') }}">
    <link rel="icon" href="{{ asset('uploads/favicon.ico') }}" type="image/x-icon">
    @stack('css')
    @php
    $basic_settings=get_option('basic_settings');
   
    @endphp
    <style type="text/css">
     :root {
      --main-theme-color: {{  $basic_settings->theme_color ?? '#6c28fa'  }};   
     }
   </style>
   <link rel="stylesheet" href="{{ asset('main/assets/css/style.css') }}">
   
   @if(file_exists('uploads/custom.css'))
     <link rel="stylesheet" href="{{ asset('uploads/custom.css') }}">
   @endif
</head>

<body>
    @yield('content')
    <!-- footer area start -->
    @include('layouts.main.partials.footer',['basic_settings'=>$basic_settings])
    <!-- footer area end -->
    <script src="{{ asset('backend/admin/assets/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{ asset('main/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('main/assets/js/iconify.min.js')}}"></script>
    <script src="{{ asset('main/assets/js/hc-offcanvas-nav.js') }}"></script>
    <script src="{{ asset('main/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('main/assets/js/script.js')}}"></script>
    @stack('js')
    <script src="{{ asset('backend/admin/assets/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('backend/admin/assets/js/custom.js') }}"></script>
    <script src="{{ asset('backend/admin/assets/js/form.js') }}"></script>
    @if(file_exists('uploads/custom.js'))
    <script src="{{ asset('uploads/custom.js') }}"></script>
    @endif
</body>

</html>