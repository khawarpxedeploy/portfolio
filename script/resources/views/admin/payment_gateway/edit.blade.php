@extends('layouts.backend.app')

@section('title','Edit Payment Gateway')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Edit Payment Gateway','prev'=> route('admin.payment_gateway.index')])
@endsection

@push('before_css')
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/selectric.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
           <form method="POST" action="{{ route('admin.payment_gateway.update', $gateway->id) }}" class="basicform">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Name') }}</label>
                        <div class="col-sm-12 col-md-7">
                           <input type="text" class="form-control" name="name" value="{{ $gateway->name }}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Rate') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="rate" value="{{ $gateway->rate }}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Test Mode') }}</label>
                        <div class="col-sm-12 col-md-7">
                           <select class="form-control selectric" name="test_mode">
                                    <option value="1" {{ $gateway->test_mode == 1 ? 'selected' : '' }}> {{ __('Enable') }}</option>
                                    <option value="0" {{ $gateway->test_mode == 0 ? 'selected' : '' }}>
                                                    {{ __('Disable') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Currency Name') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="currency_name" value="{{ $gateway->currency_name }}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Charge') }}</label>
                        <div class="col-sm-12 col-md-7">
                           <input type="text" class="form-control" name="charge" value="{{ $gateway->charge }}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label
                            class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Status') }}</label>
                        <div class="col-sm-12 col-md-7">
                           <select class="form-control selectric" name="status">
                                    <option value="1" {{ $gateway->status == 1 ? 'selected' : '' }}> {{ __('Active') }}</option>
                                    <option value="0" {{ $gateway->status == 0 ? 'selected' : '' }}>{{ __('Deactive') }}</option>
                            </select>
                        </div>
                    </div>
                     <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Logo') }}</label>
                        <div class="col-sm-12 col-md-7">
                             <input type="file" id="logo" class="form-control" name="logo">
                              @if ($gateway->logo != '')
                              <img src="{{ asset($gateway->logo) }}" alt="" class="image-thumbnail mt-2" height="50">
                              @endif
                        </div>
                    </div>
                     @if($gateway->is_auto == 1)
                      @php $gateways = json_decode($gateway->data) @endphp
                        @foreach ($gateways ?? [] as $key => $cred)
                     <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ ucwords(str_replace("_", " ", $key)) }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="data[{{ $key }}]" value="{{ $cred }}">
                        </div>
                    </div>
                    @endforeach
                    @endif
                    @if($gateway->is_auto == 0)
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Payment Instruction') }}</label>
                        <div class="col-sm-12 col-md-7">
                           <textarea class="form-control" name="data" required="">{{ $gateway->data }}</textarea>
                        </div>
                    </div>
                    @endif
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