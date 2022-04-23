<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Online CV') }}</title>
    <link rel="shortcut icon" href="{{ asset('uploads/favicon.ico') }}">

    <!-- css here -->
    <link rel="stylesheet" href="{{ asset('cv/theme2/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cv/theme2/css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('cv/theme2/css/default.css') }}">
    @stack('css')
</head>

<body>
    @yield('content')
    <!-- js here -->
    <script src="{{ asset('cv/theme2/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('cv/theme2/js/iconify.min.js') }}"></script>
    <script src="{{ asset('cv/theme2/js/html2pdf.bundle.js') }}"></script>
    <script src="{{ asset('cv/theme2/js/user_cv.js') }}"></script>
    @stack('js')
</body>

</html>