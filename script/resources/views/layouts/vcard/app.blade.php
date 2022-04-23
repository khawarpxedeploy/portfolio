<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Vcard - Digital Business Card') }}</title>

    <link rel="stylesheet" href="{{ asset('vcard/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vcard/assets/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('vcard/assets/css/style.css') }}">
</head>

<body style="background: {{ $data->color ?? ''}}">
  
    <!-- main area start -->
    @yield('content')
    <!-- main area end -->

    <script src="{{ asset('vcard/assets/js/form.js') }}"></script>
    <script src="{{ asset('vcard/assets/js/iconify.min.js') }}"></script>
</body>

</html>