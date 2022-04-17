<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ __('CV Builder For ') }}{{ env('APP_NAME') }}</title>
    <link rel="shortcut icon" href="{{ asset('uploads/favicon.ico') }}"/>

    <!-- css here -->
    <link rel="stylesheet" href="{{ asset('main/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('main/assets/css/cv_builder/font.css') }}">
    <link rel="stylesheet" href="{{ asset('main/assets/css/default.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('main/assets/css/cv_builder/style.css') }}">
    <link rel="stylesheet" href="{{ asset('cv/theme1/css/style.css') }}">
    @stack('css')

</head>

<body>

    @include('layouts.builder.partials.header')
    <!--- Main Content --->
    @yield('content')

    @include('layouts.builder.partials.footer')

    <input type="hidden" id="upgrate_plan_url" value="{{ route('user.plan.index') }}">
    <script src="{{ asset('backend/admin/assets/js/jquery-3.5.0.min.js') }}"></script>
    <script src="{{ asset('backend/admin/assets/js/popper.min.js') }}"></script>
    <!-- js here -->
    <script src="{{ asset('main/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('main/assets/js/iconify.min.js') }}"></script>
    <script src="{{ asset('backend/admin/assets/js/form.js') }}"></script>
    <script src="{{ asset('backend/admin/assets/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('backend/admin/assets/js/ntc.js') }}"></script>
    <script src="{{ asset('backend/admin/assets/js/cv.js') }}"></script>
    @stack('js')
</body>

</html>