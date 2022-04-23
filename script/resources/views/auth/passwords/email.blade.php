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
                        <h2>{{ __('Reset Password') }}</h2>
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
                            @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                            @endif
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>{{ __('Reset Password') }}</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus
                                            placeholder="{{ __('Enter email address') }}">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="button">
                                        <button type="submit">{{ __('Send Password Reset Link') }}</button>
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

