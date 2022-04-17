@extends('layouts.backend.app')

@section('title','Edit Plan Information')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Edit Plan Information','prev'=>
route('admin.tenant.index')])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="basicform" action="{{ route('admin.tenant.update',$tenant->id) }}"
                    method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Duration') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" required="" name="duration"
                                value="{{ $tenant->duration ?? '' }}" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Storage Size') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" required="" name="storage_size"
                                value="{{ $tenant->storage_size ?? '' }}" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Resume Builder') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="form-control" name="resume_builder">
                                <option value="1" {{ $tenant->resume_builder == 1 ? 'selected' : '' }}>
                                    {{ __('Active') }}</option>
                                <option value="0" {{ $tenant->resume_builder == 0 ? 'selected' : '' }}>
                                    {{ __('Inactive') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Portfolio Builder') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="form-control" name="portfolio_builder">
                                <option value="1" {{ $tenant->portfolio_builder == 1 ? 'selected' : '' }}>
                                    {{ __('Active') }}</option>
                                <option value="0" {{ $tenant->portfolio_builder == 0 ? 'selected' : '' }}>
                                    {{ __('Inactive') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Custom Domain') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="form-control" name="custom_domain">
                                <option value="1" {{ $tenant->custom_domain == 1 ? 'selected' : '' }}>
                                    {{ __('Active') }}</option>
                                <option value="0" {{ $tenant->custom_domain == 0 ? 'selected' : '' }}>
                                    {{ __('Inactive') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Sub Domain') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="form-control" name="sub_domain">
                                <option value="1" {{ $tenant->sub_domain == 1 ? 'selected' : '' }}>
                                    {{ __('Active') }}</option>
                                <option value="0" {{ $tenant->sub_domain == 0 ? 'selected' : '' }}>
                                    {{ __('Inactive') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Analytics') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="form-control" name="analytics">
                                <option value="1" {{ $tenant->analytics == 1 ? 'selected' : '' }}>
                                    {{ __('Active') }}</option>
                                <option value="0" {{ $tenant->analytics == 0 ? 'selected' : '' }}>
                                    {{ __('Inactive') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Online Businesscard') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="form-control" name="online_businesscard">
                                <option value="1" {{ $tenant->online_businesscard == 1 ? 'selected' : '' }}>
                                    {{ __('Active') }}</option>
                                <option value="0" {{ $tenant->online_businesscard == 0 ? 'selected' : '' }}>
                                    {{ __('Inactive') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('QR Code') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="form-control" name="qrcode">
                                <option value="1" {{ $tenant->qrcode == 1 ? 'selected' : '' }}>
                                    {{ __('Active') }}</option>
                                <option value="0" {{ $tenant->qrcode == 0 ? 'selected' : '' }}>
                                    {{ __('Inactive') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Post Limit') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" required="" name="postlimit"
                                value="{{ $tenant->postlimit ?? '' }}" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button class="btn btn-primary basicbtn" type="submit">{{ __('Save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection