@extends('layouts.backend.app')

@section('title','Customize Menu')

@push('css')
<link rel="stylesheet" href="{{ asset('backend/admin/assets/css/font-awesome-5.15.3-css-all.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/admin/assets/css/bootstrap-iconpicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/admin/assets/css/menu.css') }}">
@endpush

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Menu structure & List'])
@endsection

@section('content')
<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h6 class="font-weight-bolder mb-0">{{ __('Menu List') }}</h6>
                <form id="frmEdit" class="form-horizontal">
                    <div class="form-group">
                        <label>{{ __('Text') }}</label>
                        <div class="input-group form-group">
                            <input type="text" class="form-control item-menu" name="text" id="text" placeholder="Text"
                                autocomplete="off" aria-describedby="button-addon2" height="40">
                            <button class="btn btn-outline-primary mb-0 iconpicker" data-icon="fas fa-home"
                                role="iconpicker" type="button" id="button-addon2"></button>
                            <input type="hidden" name="icon" class="item-menu">

                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{ __('URL') }} <sup>*</sup></label>
                        <input type="text" class="form-control item-menu" name="href" id="href" placeholder="URL"
                            required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>{{ __('Target') }} <sup>*</sup></label>
                        <select class="form-control item-menu" name="target" id="target">
                            <option value="_self">{{ __('Self') }}</option>
                            <option value="_blank">{{ __('Blank') }}</option>
                            <option value="_top">{{ __('Top') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Tooltip') }} <sup>*</sup></label>
                        <input type="text" name="title" class="form-control item-menu" id="title" placeholder="Tooltip">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button type="button" id="btnUpdate"
                                class="btn btn-update  btn-warning text-white float-end col-12" disabled><i
                                    class="fas fa-sync-alt"></i> {{ __('Update') }}</button>
                        </div>
                        <div class="col-6">
                            <button type="button" id="btnAdd" class="btn btn-success col-12 w-100"><i class="fas fa-plus"></i>
                                {{ __('Add') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center mb-4">
                    <div class="col-6">
                        <h6 class="font-weight-bolder mb-0">{{ __('Menu structure') }}</h6>
                    </div>
                    <div class="col-6 save-menu">
                        <div class="float-right">
                            <form class="basicform" class="float-right" method="post"
                            action="{{ route('admin.menus.MenuNodeStore') }}">
                             @csrf 
                             <input type="hidden" name="data" id="data"> <input type="hidden" name="menu_id" value="{{ $info->id }}">
                            <button id="form-button" class="btn btn-primary basicbtn btn-lg float-end"
                                    type="submit">{{ __('Save Changes') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
                <ul id="myEditor" class="sortableLists list-group">
                </ul>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="menu_data" value="{{ $info->data }}">
@endsection

@push('js')
<script src="{{ asset('backend/admin/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/admin/assets/js/jquery-menu-editor.min.js') }}"></script>
<script src="{{ asset('backend/admin/assets/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
<script src="{{ asset('backend/admin/assets/js/user-single.iconpicker.js') }}"></script>
<script src="{{ asset('backend/admin/assets/js/menu.js') }}"></script>
@endpush