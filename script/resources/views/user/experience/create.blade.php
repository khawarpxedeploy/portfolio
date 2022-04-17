@extends('layouts.backend.app')

@section('title','Create New Experience')

@push('css')
<link rel="stylesheet" href="{{ asset('backend/admin/assets/css/font-awesome-5.15.3-css-all.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/admin/assets/css/bootstrap-iconpicker.min.css') }}">
@endpush

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Create New','prev'=> route('user.experience.index')])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ __('Create New Experience') }}</h4>
            </div>
            <form method="POST" action="{{ route('user.experience.store') }}" enctype="multipart/form-data"
                class="basicform_with_reset">
                @csrf
                <div class="card-body">
                   
                    <div class="form-group row mb-4">
                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Position') }}</label>
                        <div class="col-sm-12 col-md-7"><input maxlength="30" type="text" id="title" class="form-control"
                                name="position"></div>
                    </div>
                     <div class="form-group row mb-4">
                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Company Name') }}</label>
                        <div class="col-sm-12 col-md-7"><input maxlength="30" type="text" id="title" class="form-control"
                                name="company"></div>
                    </div>
                    <div class="form-group row mb-2">
                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Icon') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <div class="input-group form-group">
                                <input type="text" readonly class="form-control icon"
                                    aria-describedby="button-addon2" name="icon" height="40">
                                <button class="btn btn-outline-primary mb-0 iconpicker"
                                    data-icon="fas fa-home" role="iconpicker" type="button"
                                    id="button-addon2"></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Start Date') }}</label>
                        <div class="col-sm-12 col-md-7"><input type="text" class="form-control"
                                name="start_date" /></div>
                    </div>


                    <div class="form-group row mb-4">

                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('End Date') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="end_date" />
                            <p class="text-warning text-xs">
                                {{ __("if you are currently working with this position please don't fill this field ") }}
                            </p>
                        </div>

                    </div>

                    <div class="form-group row mb-4">
                        <label
                            class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Short Description') }}</label>
                        <div class="col-sm-12 col-md-7"><textarea maxlength="100" name="description" cols="30" rows="10"
                                class="form-control"></textarea></div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7 text-center">
                            <button type="submit" class="btn btn-primary w-100 btn-lg basicbtn">{{ __('Submit') }}</button>
                            </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('backend/admin/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/admin/assets/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
<script src="{{ asset('backend/admin/assets/js/user-single.iconpicker.js') }}"></script>
@endpush