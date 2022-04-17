@extends('layouts.backend.app')
@section('title','Create Order')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Create New Order','prev'=>
route('admin.order.index')])
@endsection

@push('before_css')
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/selectric.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <form method="POST" action="{{ route('admin.order.store') }}" class="basicform_with_reset">
                @csrf
                <div class="card-body">
                    
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Email') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="email" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Username') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="tenant" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Payment Gateway') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="getway_id">
                                <option value="" selected disabled>{{ __('Select Gateway') }}</option>
                                @foreach ($getways as $getway)
                                <option value="{{ $getway->id }}">{{ $getway->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Trx Id') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="trx" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Plan') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="plan_id">
                                <option value="" selected disabled>{{ __('Select Plan') }}</option>
                                @foreach ($plans as $plan)
                                <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label
                            class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Send Email to customer?') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="email_status">
                                <option value="1">{{ __('Yes') }}
                                </option>
                                <option value="0" selected>{{ __('No') }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button class="btn btn-primary basicbtn w-100 btn-lg" type="submit">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('backend/admin/assets/js/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('backend/admin/assets/js/admin-plan.create.js') }}"></script>
@endpush