@extends('layouts.backend.app')

@section('title','Create New')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Create New Workprocess','button_name'=>'Manage Workprocess','button_link'=> route('user.workprocess.index')])
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('backend/admin/assets/css/font-awesome-5.15.3-css-all.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/admin/assets/css/bootstrap-iconpicker.min.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Create New Workprocess') }}</h4>
                        </div>
                        <form method="POST" action="{{ route('user.workprocess.store') }}"
                            enctype="multipart/form-data" class="basicform_with_reset">@csrf
                            <div class="card-body">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>{{ __('Whoops!') }}</strong>
                                    {{ __('There were some problems with your input.') }}<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <div class="form-group row mb-4">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Title') }}</label>
                                    <div class="col-sm-12 col-md-7"><input type="text" class="form-control" required=""
                                            name="title" /></div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label
                                        class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Select Icon') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="input-group form-group">
                                            <input type="text" class="form-control icon" required
                                                aria-describedby="button-addon2" name="icon" height="40"
                                                readonly>
                                            <button class="btn btn-outline-primary mb-0 iconpicker"
                                                data-icon="fas fa-home" role="iconpicker" type="button"
                                                id="button-addon2"></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Description') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="des" class="form-control" id="" cols="30" rows="10"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary basicbtn w-100 btn-lg" type="submit">{{ __('Save') }}</button>
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
@endsection

@push('js')
<script src="{{ asset('backend/admin/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/admin/assets/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
<script src="{{ asset('backend/admin/assets/js/user-single.iconpicker.js') }}"></script>
@endpush