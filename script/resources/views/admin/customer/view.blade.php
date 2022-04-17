@extends('layouts.backend.app')

@section('title','Customers')

@section('head')
@include('layouts.backend.partials.headersection',['prev'=>route('admin.customer.index'),'title'=>'All Customers'])
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('backend/admin/assets/css/summernote/summernote-bs4.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-md-5">
        <div class=" mb-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-12">
                                    <img src="{{ asset($user->image ?? null) }}" alt="">
                                </div>
                            </div>

                            <div class="row mt-4 mb-4">
                                <div class="col-md-12">
                                    <ul class="list-group">
                                        <li class="list-group-item active">{{ __('User Basic Info') }}</li>
                                        <li class="list-group-item">{{ __('Name:') }} {{ $user->name }}</li>
                                        <li class="list-group-item">{{ __('Email :') }} {{ $user->email }}</li>
                                        <li class="list-group-item">{{ __('Domain :') }}
                                            {{ env('APP_URL_WITH_TENANT') }}{{ $user->tenant->id }}</li>
                                        <li class="list-group-item">{{ __('Total Orders :') }} {{ $orders_count }}</li>
                                        <li class="list-group-item">{{ __('Total Posts:') }} {{ $all_blogs }}</li>
                                        <li class="list-group-item">{{ __('Storage Used:') }} {{ $folder_size }} / 0 MB
                                        </li>
                                        <li class="list-group-item">{{ __('Joining Date:') }}
                                            {{ $user->created_at->format('M d Y') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <form class="basicform_with_reset" action="{{ route('admin.customer.view-mail') }}" method="post">
                @csrf
                <div class="card-body">
                    <h6>{{ __('Send Mail') }}</h6>
                    <div class="form-group row">
                        <label class="col-12 col-md-2 col-lg-12">{{ __('Mail To') }}</label>
                        <div class="col-sm-12 col-md-12">
                            <input type="text" id="name" class="form-control" name="mail_to" value="{{ $user->email }}"
                                readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class=" col-12 col-md-12 col-lg-12">{{ __('Subject') }}</label>
                        <div class="col-sm-12 col-md-12">
                            <input type="text" id="subject" class="form-control" name="subject">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class=" col-12 col-md-12 col-lg-12">{{ __('Message') }}</label>
                        <div class="col-sm-12 col-md-12">
                            <textarea name="message" class="form-control" id="summernote"></textarea>
                        </div>
                    </div>

                    <div class="form-group ">
                        <button class="btn btn-primary basicbtn" type="submit">{{ __('Send') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
               <h4> {{ __('Plan Purchase History') }}</h4>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table">
                        <thead>
                            <tr>

                                <th>
                                    {{ __('Invoice') }}</th>
                                <th>
                                    {{ __('trx') }}</th>
                                <th>
                                    {{ __('Plan Name') }}</th>
                                <th>
                                    {{ __('Getway Name') }}</th>
                                <th>
                                    {{ __('Price') }}</th>
                                <th>
                                    {{ __('Tax') }}</th>
                                <th>
                                    {{ __('Created At') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tbody>
                            @foreach ($orders ?? [] as $order)
                            <tr>

                                <td>
                                    {{ $order->invoice_no }}
                                </td>
                                <td>
                                    {{ $order->trx }}
                                </td>
                                <td>
                                    {{ $order->plan->name }}
                                </td>
                                <td>
                                    {{ $order->getway->name }}
                                </td>
                                <td>
                                    {{ $order->price }}
                                </td>
                                 <td>
                                    {{ $order->tax }}
                                </td>
                                <td>
                                    {{ $order->created_at->isoFormat('LL') }}
                                   
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-4">
                        {{ $orders->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@if(env('CONTENT_EDITOR') == true)
@push('js')
<script src="{{ asset('backend/admin/assets/js/summernote-bs4.js') }}"></script>
<script src="{{ asset('backend/admin/assets/js/admin-summernote.js') }}"></script>
@endpush
@endif