@extends('layouts.backend.app')

@section('title','Edit Plan Information')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Edit Profile','prev'=>
route('admin.tenant.index')])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="basicform" action="{{ route('admin.tenant.profile.update',$tenant->id) }}"
                    method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Profile Id') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" required="" name="id"
                                value="{{ $tenant->id ?? '' }}" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Expire Date') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="date" class="form-control" required="" name="will_expire"
                                value="{{ $tenant->will_expire ?? '' }}" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Status') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="form-control" name="status">
                                <option value="1" @if($tenant->status == 1) selected @endif>{{ __('Active') }}</option>
                                <option value="2" @if($tenant->status == 2) selected @endif>{{ __('Pending') }}</option>
                                <option value="0" @if($tenant->status == 0) selected @endif>{{ __('Disable') }}</option>
                            </select>
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
<input type="hidden" id="url" value="{{ route('admin.tenant.index') }}">
@endsection

@push('js')
<script>
    "use strict";
    function success(argument) {
        window.location = $('#url').val()
    }
</script>
@endpush