@extends('layouts.backend.app')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Edit Customer','prev'=>route('admin.customer.index')])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="mb-4">
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                           
                            <form class="basicform" action="{{ route('admin.customer.update',$user->id) }}"
                                method="post">
                                @csrf
                                @method('PUT')

                                <div class="form-group row mb-4">
                                    <label
                                        class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Customer Username') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="input-group mb-2">
                                            <div class="input-group-appened">
                                                <div class="input-group-text bg-light">{{ env('APP_URL_WITH_TENANT') }}
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" required="" name="user_name"
                                                value="{{ $user->tenant->id }}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Customer Name') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" required="" name="name"
                                                value="{{ $user->name }}" />
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label
                                        class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Customer Email') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="email" class="form-control" required="" name="email"
                                            value="{{ $user->email }}" />
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Password') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="password" class="form-control" name="password" />
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Status') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control" name="status">
                                            <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>
                                                {{ __('Active') }}</option>
                                            <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>
                                                {{ __('Inactive') }}</option>
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
        </div>
    </div>
</div>
@endsection