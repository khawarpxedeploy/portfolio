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
                            <li><a href="#">
                                <div class="single-step text-center">
                                    <span>1</span>
                                    <p>{{ __('Step 1') }}</p> 
                                </div>
                            </a></li>
                            <li class="active"><a href="#">
                                <div class="single-step text-center">
                                    <span>2</span>
                                    <p>{{ __('Step 2') }}</p> 
                                </div>
                            </a></li>
                        </ul>
                    </div>
                    <div class="registation-form">
                        <form action="{{ route('register.step2.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name">{{ __('Address') }}</label>
                                        <textarea name="address" class="form-control" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name">{{ __('City') }}</label>
                                        <input type="text" placeholder="{{ __('City') }}" class="form-control" name="city">
                                    </div>
                                </div>
                                @php
                                    $country_file_json = file_get_contents(resource_path('lang/countrylist.json'));
                                    $countries = json_decode($country_file_json);
                                @endphp
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="country">{{ __('Country') }}</label>
                                        <select name="country" class="form-control">
                                            @foreach ($countries as $country)
                                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="password">{{ __('Postal Code') }}</label>
                                        <input type="text" class="form-control" placeholder="{{ __('Postal Code') }}" name="postal_code">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="confirm_pas">{{ __('Phone Number') }}</label>
                                        <input type="number" placeholder="{{ __('Phone Number') }}" class="form-control" name="phone_number">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="confirm_pas">{{ __('Business Or Personal Website(Optional)') }}</label>
                                        <input type="text" placeholder="{{ __('Website Address') }}" class="form-control" name="website">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="register-btn f-right">
                                        <button type="submit">{{ __('Create My Store') }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="social-auth-section">
                                <div class="text-center">
                                    <div class="or">{{ __('OR') }}</div>
                                </div>
                                <div class="row">

                                    <div class="col-lg-6 offset-lg-3">
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
