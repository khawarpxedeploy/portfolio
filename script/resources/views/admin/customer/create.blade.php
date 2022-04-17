@extends('layouts.backend.app')
@section('title','Customer Create')

@section('head')
@include('layouts.backend.partials.headersection',['prev'=>route('admin.customer.index'),'title'=>'Create Customer'])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
           
            <div class="row">
                <div class="col-12">
                    <div class="card">
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
                            <form class="basicform_with_reset" action="{{ route('admin.customer.store') }}"
                                method="post">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label
                                        class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Customer Name') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" required="" name="name" />
                                    </div>
                                </div>


                                <div class="form-group row mb-4">
                                    <label
                                        class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Customer Email') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="email" class="form-control" required="" name="email" />
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Password') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="password" class="form-control" required="" name="password" />
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Getway') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control" name="getway_id">
                                            <option value="" selected disabled>{{ __('Select Getway') }}</option>
                                            @foreach ($getways as $getway)
                                            <option value="{{ $getway->id }}">{{ $getway->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Transaction Id') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" required="" name="trx" />
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Plan') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control" name="plan_id">
                                            <option value="" selected disabled>{{ __('Select Plan') }}</option>
                                            @foreach ($plans as $plan)
                                            <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label
                                        class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Profile Name') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="input-group mb-2">
                                            <div class="input-group-appened">
                                                <div class="input-group-text bg-light">{{ env('APP_URL_WITH_TENANT') }}
                                                </div>
                                            </div>
                                            <input type="text" value="" class="form-control " name="tenant"
                                                placeholder="Profile Name">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Status') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control" name="status">
                                            <option value="1">{{ __('Active') }}</option>
                                            <option value="0">{{ __('Inactive') }}</option>
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