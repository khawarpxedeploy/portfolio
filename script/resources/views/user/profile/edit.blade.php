@extends('layouts.backend.app')

@section('head')
@include('layouts.backend.partials.headersection')
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <div class="row w-100 align-items-center">
                    <div class="col-lg-6">
                        <h4 class="mb-0">{{ __('Profile Edit') }}</h4>
                    </div>
                    <div class="col-lg-6">
                        <div class="float-right">
                            <a class="btn bg-primary text-light mb-0" href="{{ route('user.profile.index') }}">{{ __('Profile View') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="">
                        <div class="card-body">
                            <form method="POST" action="{{ route('user.profile.store') }}" class="basicform">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group row mb-4">
                                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Name') }}</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="name" value="{{old('name') ? old('name') :Auth()->user()->name}}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Email') }}</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" id="emil" class="form-control" name="email" value="{{old('email') ? old('email') :Auth()->user()->email}}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Phone') }}</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" id="phone" class="form-control" name="phone" value="{{old('phone') ? old('phone') :Auth()->user()->phone}}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('New Password') }}</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" id="password" class="form-control" name="password">
                                        </div>
                                    </div>
                                    @if (Auth()->user()->image != '')
                                    <div class="form-group row mb-4">
                                        <label class="text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <img src="{{ asset(Auth()->user()->image) }}" alt="" class="image-thumbnail " height="120">
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-group row mb-4">
                                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Image') }}</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                    </div>
                                   
                                    <div class="form-group row mb-4">
                                        <label class="text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <button class="btn btn-primary w-100 btn-lg" type="submit">{{ __('Update') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
