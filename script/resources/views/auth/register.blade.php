@extends('layouts.main.app')

@section('content')
@include('layouts.main.partials.header')

{{-- breadgrump area start --}}
<section>
    <div class="breadgreamup-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="breadgrump-content text-center">
                        <h2>{{ __('Register') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- breadgrump area end --}}

{{-- main area start --}}
<section>
    <div class="main-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="step-section">
                        <ul>
                            <li class="active"><a href="#">
                                <div class="single-step text-center">
                                    <span>1</span>
                                    <p>{{ __('Step 1') }}</p> 
                                </div>
                            </a></li>
                            <li><a href="#">
                                <div class="single-step text-center">
                                    <span>2</span>
                                    <p>{{ __('Step 2') }}</p> 
                                </div>
                            </a></li>
                        </ul>
                    </div>
                    <div class="registation-form">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('register.step1') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">{{ __('Name') }}</label>
                                        <input type="text" placeholder="{{ __('Your Name') }}" class="form-control" name="name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">{{ __('Email') }}</label>
                                        <input type="email" placeholder="{{ __('Your Email') }}" class="form-control" name="email">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="store-name-section">
                                        <label for="name">{{ __('Profile Name') }}</label>
                                        @if(env('REGISTER_WITH_SUBDOMAIN') == false)
                                        <div class="d-flex align-items-center">
                                            <div class="store-url-section">
                                                <p>{{ env('APP_URL_WITH_TENANT') }}</p>
                                            </div>
                                            <div class="store-input">
                                                <div class="form-group">
                                                    <input type="text" name="store_name" placeholder="{{ __('Profile Name') }}" class="form-control" id="store_name" onchange="store_check('{{ route('register.store_check') }}')">
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="d-flex align-items-center">
                                            
                                            <div class="store-input">
                                                <div class="form-group">
                                                    <input type="text" name="store_name" placeholder="{{ __('Profile Name') }}" class="form-control" id="store_name" onchange="store_check('{{ route('register.store_check') }}')">
                                                </div>
                                            </div>
                                            <div class="store-url-section">
                                                <p>{{ '.'.env('APP_PROTOCOLESS_URL') }}</p>
                                            </div>
                                        </div>

                                        @endif
                                        <div class="error-show">
                                            <p id="error_show"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="password">{{ __('Password') }}</label>
                                        <input type="password" class="form-control" placeholder="{{ __('Password') }}" name="password">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="confirm_pas">{{ __('Confirmation Password') }}</label>
                                        <input type="password" placeholder="{{ __('Confirmation Password') }}" class="form-control" name="password_confirmation">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-check form-check-info text-left">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="agree">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ __('I agree with the') }} <a target="_blank" class="text-primary" href="{{ url('/page/terms-and-conditions') }}"
                                                class="text-dark font-weight-bolder">{{__('Terms and
                                                Conditions')}}</a>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="register-btn f-right">
                                        <button class="submitbtn" disabled="" type="submit">{{ __('Next') }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="social-auth-section">
                                <div class="text-center">
                                    <div class="or">{{ __('OR') }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 offset-lg-3">
                                        <div class="social d-flex justify-content-around">
                                           @if(!empty(env('GITHUB_CLIENT_ID')))
                                        <div>
                                            <a href="{{ route('login.github') }}" class="text-primary btn mt-2 d-flex justify-content-center align-items-center p-3">
                                                <span class="iconify" data-icon="akar-icons:github-fill" data-inline="false"></span>
                                            </a>
                                        </div>
                                        @endif
                                        @if(!empty(env('GOOGLE_CLIENT_ID')))
                                        <div class="">
                                            <a href="{{ route('login.google') }}"  class="text-primary btn mt-2 d-flex justify-content-center align-items-center p-3">
                                                <span class="iconify" data-icon="ant-design:google-outlined" data-inline="false"></span>
                                            </a>
                                        </div>
                                        @endif

                                         @if(!empty(env('FACEBOOK_CLIENT_ID')))
                                        <div class="">
                                            <a href="{{ route('login.facebook') }}"  class="text-primary btn mt-2 d-flex justify-content-center align-items-center p-3">
                                                <span class="iconify" data-icon="grommet-icons:facebook-option" data-inline="false"></span>
                                            </a>
                                        </div>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="already-have-account-section text-center">
                                        <p>{{ __('Already have an account?') }}</p> <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- main area end --}}
@endsection

@push('js')
    <script>
        function store_check(url)
        {
            $('.submitbtn').attr('disabled','');
            var value = $('#store_name').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: url,
                data: {store_name: value},
                dataType: 'json',
                success: function(response){ 
                    if(response.error)
                    {
                        $('#error_show').text(response.error);
                        $('.store-url-section').addClass('error');
                        $('#store_name').addClass('error');
                    }else{
                       if(response == 'success')
                       {
                           $('.submitbtn').removeAttr('disabled');
                            $('.store-url-section').removeClass('error');
                            $('#store_name').removeClass('error');
                            $('#error_show').text('');
                       }
                    }
                },
                error: function(xhr, status, error) 
                {
                    $.each(xhr.responseJSON.errors, function (key, item) 
                    {
                        Sweet('error',item)
                        $("#errors").html("<li class='text-danger'>"+item+"</li>")
                    });
                    errosresponse(xhr, status, error);
                }
            })
        }
    </script>
@endpush
