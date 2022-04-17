@extends('layouts.backend.app')

@section('title','Edit Menu')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Edit Menu'])
@endsection

@push('before_css')
<link rel="stylesheet" href="{{ asset('backend/admin/assets/css/selectric.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form method="post" class="basicform"
                            action="{{ route('admin.menu.update',$info->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <strong>{{ __("Whoops!") }}</strong>
                                    {{ __("There were some problems with your input.") }}<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                <div class="form-group row ">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Menu Name') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="name" class="form-control" id="name"
                                            value="{{ $info->name }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label
                                        class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Menu Position') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control selectric" name="position">
                                            @if(!empty($positions))
                                            @foreach($positions as $key=>$row)
                                            <option value="{{ $row['position'] }}" @if($info->position ==
                                                $row['position'])
                                                selected="" @endif>{{ $row['position'] }}</option>
                                            @endforeach
                                            @else
                                            <option value="header" @if($info->position=='header') selected=""
                                                @endif>{{ __('Header') }}</option>
                                            <option value="footer_left" @if($info->position=='footer_left') selected=""
                                                @endif>{{ __('Footer Left') }}</option>
                                            <option value="footer_right" @if($info->position=='footer_right')
                                                selected=""
                                                @endif>{{ __('Footer Right') }}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label
                                        class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Select Language') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control selectric" name="lang">
                                            @foreach($langs as $row)
                                            <option value="{{ $row->name }}" @if($info->lang== $row->name) selected=""
                                                @endif>{{ $row->data }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Status') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="status" class="form-control selectric">
                                            <option value="1" @if($info->status==1) selected=""
                                                @endif>{{ __('Active') }}
                                            </option>
                                            <option value="0" @if($info->status==0) selected="" @endif>{{ __('Draft') }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary btn-lg w-100" type="submit">{{ __('Update') }}</button>
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
<script src="{{ asset('backend/admin/assets/js/jquery.selectric.min.js') }}"></script>
@endpush