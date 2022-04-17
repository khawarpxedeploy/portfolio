@extends('layouts.backend.app')

@section('title','Create Domain')
@push('css')
<link rel="stylesheet" href="{{ asset('backend/admin/assets/css/summernote/summernote-bs4.css') }}" />
@endpush

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Create Domain'])
@endsection

@push('before_css')
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/selectric.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4>{{ __('Create Domain') }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="basicform_with_reset" action="{{ route('admin.domain.store') }}" method="post">
                                    <div class="form-group row mb-4">
                                        <label class="text-md-right col-12 col-md-3 col-lg-3">
                                            {{ __('Domain Name Without Protocol') }} <br />
                                            <small class="text-danger">{{ __('example.com') }}</small>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" required="" name="domain_name" />
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label
                                            class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Full Domain With Protocol') }}
                                            <small class="text-danger">{{ __('https://example.com') }}</small></label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" required="" name="full_domain" />
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label
                                            class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Customer Email') }}</label>
    
                                        <div class="col-sm-12 col-md-7">
                                            <input type="email" class="form-control" required="" name="email" id="email"
                                                value="" />
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Status') }}</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="status">
                                                <option value="1">{{ __('Active') }}</option>
                                                <option value="3">{{ __('Requested') }}</option>
                                                <option value="2">{{ __('Draft') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <button class="btn btn-primary basicbtn btn-lg w-100" type="submit">{{ __('Save') }}</button>
                                        </div>
                                    </div>
                                    <small class="">
                                        {{ __('Subdomain Example:') }} <b><span class="text-danger">{{ __('sub1.') }}</span>{{ __('amwork.xyz') }}</b>
                                    </small>
                                    <br />
                                    <small>
                                        {{ __('Your Root Path') }}: <b><span class="text-danger"> </span></b>
                                    </small>
                                    <br />
                                    <small>
                                        {{ __('Note:') }} <b><span
                                                class="text-danger">{{ __('Before Add New Domain Please Create Domain Manually On Your Server The Domain Root Path Is Same With Your Project Directory') }}</span></b>
                                    </small>
                                </form>
                            </div>
                            <b> </b>
                        </div>
                        <b> </b>
                    </div>
                    <b> </b>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('backend/admin/assets/js/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('backend/admin/assets/js/admin-plan.create.js') }}"></script>
@endpush