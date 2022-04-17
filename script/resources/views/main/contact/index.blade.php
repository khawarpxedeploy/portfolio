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
                        <h2>{{ __('Contact Us') }}</h2>
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
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="contact-left-area">
                        <div class="contact-card">
                            <div class="contact-card-header">
                                <h4>{{ __('Send Us Message') }}</h4>
                            </div>
                            <div class="contact-card-body">
                                <form method="post" action="{{ route('sendMail') }}" class="basicform_with_reset">
                                    @csrf
                                <div class="contact-form">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" placeholder="{{ __('Name') }}" class="form-control" name="name" maxlength="100">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="email" placeholder="{{ __('Email') }}" class="form-control" name="email" maxlength="100">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input type="text" placeholder="{{ __('Subject') }}" class="form-control" name="subject" maxlength="100">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <textarea name="message" class="form-control" cols="30" rows="8" placeholder="{{ __('Message') }}" maxlength="250"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="button-btn">
                                                <button class="basicbtn">{{ __('Send') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                $address=get_option('basic_settings');
                @endphp
                <div class="col-lg-5">
                    <div class="map-area">
                        <iframe src="https://maps.google.com/maps?q={{ $address->address ?? null }}&z=13&ie=UTF8&iwloc=&output=embed" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- main area end --}}
@endsection