@extends('layouts.backend.app')

@section('title','Edit Other Options')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ __('Edit Other Options') }}</h4>
            </div>
            <form method="POST" action="{{ route('admin.option.other.update') }}" class="basicform">
                @csrf
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Tax') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <input class="form-control" name="tax" type="text" value="{{ $tax->value ?? ''}}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Curency Name') }}</label>
                        <div class="col-sm-12 col-md-7">
                           <input class="form-control" name="curency_name" type="text" value="{{ $curency_name->value ?? ''}}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Curency Symbol') }}</label>
                        <div class="col-sm-12 col-md-7">
                           <input class="form-control" name="currency_symbol" type="text" value="{{ $currency_symbol->value ?? ''}}">
                        </div>
                    </div>
                    
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Invoice Prefix') }}</label>
                        <div class="col-sm-12 col-md-7">
                           <input class="form-control" name="invoice_prefix" type="text" value="{{ $invoice_prefix->value ?? ''}}">
                        </div>
                    </div>
                     <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3">{{ __('Invoice Messages') }}</label>
                        <div class="col-sm-12 col-md-7">
                          <textarea class="form-control" name="invoice_mail_messages">{{ $invoice_mail_messages->value ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class=" text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button type="submit" class="btn btn-primary basicbtn btn-lg w-100">{{ __('Update') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection