<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data->name ?? '' }} {{ __('Digital Business Card') }}</title>
    <link rel="shortcut icon" href="{{ asset('uploads/'.tenant('user_id').'/favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('vcard/classic/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vcard/classic/css/font.css') }}">
    <link rel="stylesheet" href="{{ asset('vcard/classic/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('vcard/classic/css/style.css') }}">
</head>

<body style="background: {{ $data->color }}">
    <!-- main area start -->
    <section>
        <div class="main-container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="vcard-main-container" style="background-image: url('{{ asset($data->cover_image_url) }}">
                            <div class="vcard-user-content text-center">
                                <div class="user-img">
                                    <img src="{{ asset($data->profile_image_url ?? '') }}" alt="">
                                </div>
                                <div class="user-name">
                                    <h4>{{ $data->name ?? '' }}</h4>
                                </div>
                                <div class="user-position">
                                     <p>{{ $data->tagline ?? '' }}</p>
                                </div>
                                <div class="user-vcard-des">
                                  <p>{{ $data->description ?? '' }}</p>
                                </div>
                                <div class="vcard-social-links">
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
                                <div class="add-to-contact">
                                    <a href="{{ url('profile/'.tenant('id').'/download-vcard') }}"><span class="iconify" data-icon="fa:address-card"></span> {{ __('Add To Contact') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- main area end -->

    <script src="{{ asset('vcard/classic/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vcard/classic/js/iconify.min.js') }}"></script>
</body>

</html>