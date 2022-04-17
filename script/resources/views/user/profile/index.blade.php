@extends('layouts.backend.app')

@section('head')
@include('layouts.backend.partials.headersection')
@endsection

@section('content')
<div class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                <div class="row w-100 align-items-center">
                    <div class="col-lg-6">
                        <h4 class="mb-0">{{ __('Profile View') }}</h4>
                    </div>
                    <div class="col-lg-6">
                        <div class="float-right">
                            <a class="btn bg-primary text-light mb-0" href="{{ route('user.profile.create') }}"><i class="fas fa-edit"></i> {{ __('Edit Profile') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif
                <div class="table-responsive p-0">

                    <div class="profile-widget-header  text-center">
                        @if (Auth()->user()->image != '')
                        <img src="{{ asset(Auth()->user()->image) }}" alt="" class="image-thumbnail mt-2 rounded mx-auto d-block" height="120">
                        @else
                        <img alt="image" src='https://ui-avatars.com/api/?name={{Auth()->user()->name}}' class="rounded-circle profile-widget-picture ">
                        @endif
                    </div>
                    <br>
                    <table class="table align-items-center mb-0 text-center text-sm">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td><strong class="text-dark">{{ __('Name')}}</strong></td>
                                <td>{{Auth()->user()->name}}</td>
                            </tr>
                            <tr>
                                <td><strong class="text-dark">{{ __('Email')}}</strong></td>
                                <td>{{Auth()->user()->email}}</td>
                            </tr>
                            <tr>
                                <td><strong class="text-dark">{{ __('phone')}}</strong></td>
                                <td>{{Auth()->user()->phone ?? "null"}}</td>
                            </tr>

                            <tr>
                                <td><strong class="text-dark">{{ __('status')}}</strong></td>
                                <td>@if(Auth()->user()->status ==1)
                                    <span class="badge badge-primary">{{ __("Active") }}</span>
                                    @else
                                    <span class="badge badge-danger">{{ __('Inactive') }}</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="col-2"></div>
</div>
@endsection
