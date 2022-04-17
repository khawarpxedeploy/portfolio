@php
if($user == !null){
$setting = json_decode($user->value);
}else{
$setting = null;
}
$url = my_url();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config()->get('app.name') }} @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{ asset('user_frontend/plugins/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user_frontend/plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('user_frontend/plugins/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('user_frontend/css/font-awesome-5.15.3-css-all.min.css') }}">
    <script src="{{ asset('backend/admin/assets/js/kit-fontawesome.js') }}"></script>
    <link href="{{ asset('backend/admin/assets/css/style.css')}}" rel="stylesheet" />
    <link href="{{ asset('user_frontend/css/style.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset($setting->favicon_url ?? null) }}" type="image/x-icon">
    <link rel="icon" href="{{ asset($setting->favicon_url ?? null) }}" type="image/x-icon">
    <input type="hidden" id="url" value="{{ $url }}">
    @stack('css')
</head>

<body>
    @yield('content')
    <!-- contact -->
    <section class="section section-on-footer"
        data-background="{{ asset('user_frontend/images/backgrounds/bg-dots.png')}}">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="section-title">{{ __('Contact Info') }}</h2>
                </div>
                <div class="col-lg-8 mx-auto">
                    <div class="bg-white rounded text-center p-5 shadow-down">
                        <h4 class="mb-80">{{ __('Contact Form') }}</h4>
                        <form action="{{ url($url.'/contact-mail') }}" method="POST" class="basicform_with_reload row">
                            @csrf
                            <div class="col-md-6">
                                <input type="text" id="name" name="name" placeholder="Full Name"
                                    class="form-control px-0 mb-4">
                            </div>
                            <div class="col-md-6">
                                <input type="email" id="email" name="email" placeholder="Email Address"
                                    class="form-control px-0 mb-4">
                            </div>
                            <div class="col-12">
                                <input type="text" placeholder="Enter Your Subject" name="subject"
                                    class="form-control px-0 mb-4">
                            </div>
                            <div class="col-12">
                                <textarea name="message" id="message" class="form-control px-0 mb-4"
                                    placeholder="Type Message Here"></textarea>
                            </div>
                            <div class="col-lg-6 col-10 mx-auto">
                                <button class="btn btn-primary w-100 basicbtn">{{ __('Send') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /contact -->

    <!-- footer -->
    <footer class="bg-dark text-light footer-section">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h5 class="text-light">{{ __('Email') }}</h5>
                        <!-- var $settings is Cache Data  -->
                        <p class="text-white paragraph-lg font-secondary">{{ $setting->email ?? null }}</p>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text-light">{{ __('Phone') }}</h5>
                        <p class="text-white paragraph-lg font-secondary">{{ $setting->mobile ?? null}}</p>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text-light">{{ __('Address') }}</h5>
                        <p class="text-white paragraph-lg font-secondary">{{ $setting->address ?? null}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top text-center border-dark py-5">
            <p class="mb-0 text-light">{{ __('Copyright © Website -') }}
                {{ Carbon\Carbon::now()->format('Y') }}{{ __('. Powered By') }} <a
                    href="{{ url('/') }}">{{ config()->get('app.name') }}</a>
            </p>
        </div>
    </footer>
    <script src="{{ asset('user_frontend/plugins/jQuery/jquery.min.js')}}"></script>
    <script src="{{ asset('user_frontend/plugins/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{ asset('user_frontend/plugins/slick/slick.min.js')}}"></script>
    <script src="{{ asset('user_frontend/plugins/shuffle/shuffle.min.js')}}"></script>
    <script src="{{ asset('user_frontend/js/script.js')}}"></script>
    @stack('js')
    <script src="{{ asset('backend/admin/assets/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('backend/admin/assets/js/custom.js') }}"></script>
    <script src="{{ asset('backend/admin/assets/js/form.js') }}"></script>
</body>

</html>