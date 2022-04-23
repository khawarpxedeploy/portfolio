@extends('layouts.backend.app')

@section('title','Edit Order')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Edit Order','button_name'=> 'All Order','button_link'=>
route('admin.order.index')])
@endsection

@push('before_css')
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/selectric.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <form method="POST" action="{{ route('admin.order.update', $order->id) }}" class="basicform">
                @csrf
                @method('PUT')
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
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Email') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="email" value="{{ $order->user->email }}" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Tenant') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="tenant" value="{{ $tenant->id }}" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Payment Getway') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="getway_id">
                                @foreach ($getways as $getway)
                                <option value="{{ $getway->id }}"
                                    {{ $order->getway_id == $getway->id ? 'selected' : '' }}>
                                    {{ $getway->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Trx Id') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="trx" value="{{ $order->trx }}" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Plan') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="plan_id">
                                @foreach ($plans as $plan)
                                <option value="{{ $plan->id }}" {{ $order->plan_id == $plan->id ? 'selected' : '' }}>
                                    {{ $plan->name }}
                                </option>
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
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Payment Status') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="payment_status">
                                <option value="2" {{ $order->payment_status == 2 ? 'selected' : '' }}>
                                    {{ __('Pending') }}
                                </option>
                                <option value="1" {{ $order->payment_status == 1 ? 'selected' : '' }}>
                                    {{ __('Approved') }}
                                </option>
                                <option value="0" {{ $order->payment_status == 0 ? 'selected' : '' }}>
                                    {{ __('Faild') }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Status') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="status">
                                <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>
                                    {{ __('Pending') }}
                                </option>
                                <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>
                                    {{ __('Approved') }}
                                </option>
                                <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>
                                    {{ __('Cancel') }}
                                </option>
                            </select>
                        </div>
                    </div>
                     <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Assign Plan To User') }}</label>
                            <div class="col-sm-12 col-md-7">
                                <select name="plan_assign" class="form-control selectric">
                                    <option value="yes">
                                        {{ __('Yes') }}
                                    </option>
                                    <option value="no" selected="">
                                        {{ __('No') }}
                                    </option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class=" text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <button class="btn btn-primary basicbtn w-100 btn-lg" type="submit">{{ __('Update') }}</button>
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