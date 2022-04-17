<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Online CV') }}</title>
    <link rel="shortcut icon" href="{{ asset('uploads/'.tenant('user_id').'/favicon.io') }}">
    <!-- css here -->
    
    <link rel="stylesheet" href="{{ asset('cv/test/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cv/test/css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('cv/test/css/default.css') }}">
    @stack('css')
</head>

<body>
    @yield('content')
    <!-- js here -->
    <script src="{{ asset('cv/test/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('cv/test/js/iconify.min.js') }}"></script>
    <script src="{{ asset('cv/test/js/html2pdf.bundle.js') }}"></script>
    <script src="{{ asset('cv/test/js/user_cv.js') }}"></script>
    @stack('js')
</body>

</html>