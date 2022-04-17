<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

   
    <link rel="shortcut icon" type="image/jpg" href="{{ asset('uploads/'.tenant('user_id').'/favicon.ico') }}"/>


    {!! SEOMeta::generate(true) !!}
    {!! OpenGraph::generate(true) !!}
    {!! Twitter::generate(true) !!}
    {!! JsonLd::generate(true) !!}
    <!-- css here -->
    <link rel="stylesheet" href="{{ asset('theme/arafa/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/arafa/css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/arafa/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/arafa/css/index1.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/arafa/css/jquery.animatedheadline.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/arafa/css/responsive.css') }}">
    <input type="hidden" id="url" value="{{ my_url() }}">
    <link rel="stylesheet" href="{{ asset('theme/default/css/fontawesome.css') }}">
    {{ load_header() }}
</head>

<body>
    
    @yield('content')
    
    <input type="hidden" id="base_url" value="{{ my_url() }}">
    <script src="{{ asset('backend/admin/assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('theme/arafa/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/arafa/js/iconify.min.js') }}"></script>
    @stack('js')
    <script src="{{ asset('backend/admin/assets/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('theme/arafa/js/jquery.animatedheadline.min.js') }}"></script>
    <script src="{{ asset('backend/admin/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('backend/admin/assets/js/custom.js') }}"></script>
    <script src="{{ asset('backend/admin/assets/js/form.js') }}"></script>

     {{ load_footer() }}
</body>

</html>