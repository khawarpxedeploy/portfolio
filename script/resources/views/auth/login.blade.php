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
                        <h2>{{ __('Login') }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- breadgrump area end --}}

{{-- main area start --}}
<section>
    <div class="main-area pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="login-form">
                        <div class="login-title">
                            <h4>{{ __('Log In') }}</h4>
                        </div>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>{{ __('Email') }}</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Enter Email Address') }}" name="email" required autofocus value="{{ old('email') }}">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>{{ __('Password') }}</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Enter Your Password') }}" name="password" required autocomplete="current-password"
                                        aria-describedby="password-addon">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                              {{ __('Remember Me') }}
                                            </label>
                                          </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="forgot-password f-right">
                                        @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-small">
                                            {{ __('Forgot Password?') }}
                                        </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="button">
                                        <button type="submit">{{ __('Login') }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-lg-6 offset-lg-3">
                                    <div class="or-section text-center">
                                        <span>{{ __('OR') }}</span>
                                    </div>
                                    <div class="social d-flex justify-content-around mb-4">
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
                                    <div class="doesnt-have-an-account text-center">
                                        <p>{{ __("Doesn't Have An Account") }} <a href="{{ route('register') }}">{{ __('Register') }}</a></p>
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

