<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data->name ?? '' }} {{ __('Digital Business Card') }}</title>
    <link rel="shortcut icon" href="{{ asset('uploads/'.tenant('user_id').'/favicon.io') }}">

    <link rel="stylesheet" href="{{ asset('vcard/test/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vcard/test/css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('vcard/test/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('vcard/test/css/style.css') }}">
</head>
<body style="background: {{ $data->color }}">
    <!-- main area start -->
        <section>
        <div class="main-container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3 p-0">
                        <div class="single-vcard">
                            <div class="cover-img">
                                <img class="img-fluid" src="{{ asset($data->cover_image_url ?? null) }}" alt="">
                            </div>
                            <div class="user-img-name">
                                <div class="user-name">
                                    <img class="img-fluid" src="{{ asset($data->profile_image_url ?? '') }}" alt="">
                                </div>
                                <div class="user-name-position">
                                    <h4>{{ $data->name ?? '' }}</h4>
                                    <p>{{ $data->tagline ?? '' }}</p>
                                </div>
                            </div>
                            <div class="user-des">
                                <p>{{ $data->description ?? '' }}</p>
                            </div>
                            <div class="social-links">
                                @foreach ($data->social ?? [] as $social)
                                <a href="#">
                                    <div class="single-social-link">
                                        <div class="social-icon">
                                            <span class="iconify" data-icon="{{ getVcardIcon($social->field_name) }}" data-inline="false"></span>
                                        </div>
                                        <div class="social-name">
                                            <h4>{{ $social->value }}</h4>
                                            <span>{{ $social->label }}</span>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- main area end -->
    <script src="{{ asset('vcard/business/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vcard/business/js/iconify.min.js') }}"></script>
</body>

</html>