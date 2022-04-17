@extends('layouts.backend.app')

@section('title','User Dashboard')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'User Dashboard'])
@endsection

@push('before_css')
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/selectric.css') }}">
@endpush

@section('content')
<div class="row">
    @if (Auth::user()->is_trial == 1)
    <div class="col-md-12">
        <div class="alert alert-warning">
            {{ __('Your trial is ending in') }} {{ \Carbon\Carbon::parse($tenant_data->will_expire)->diffForHumans() }}
            {{ __('Please') }} <ins><a class="text" href="{{ route('user.plan.index') }}">{{ __('Enroll') }}</a></ins> {{ __('in a plan!') }}
        </div>
    </div>
    @else
    @php
     $date= \Carbon\Carbon::now()->addDays(7)->format('Y-m-d');
    @endphp
    @if($tenant_data->will_expire <= $date)
    <div class="col-md-12">
        <div class="alert alert-warning">
            {{ __('Your subscription is ending in') }} 
             {{ \Carbon\Carbon::parse($tenant_data->will_expire)->diffForHumans() }}
            {{ __('Please') }} <ins><a class="text" href="{{ url('user/gateways',$tenant_data->orderwithplan->plan_id) }}">{{ __('renew') }}</a></ins> {{ __('the plan!') }}
        </div>
    </div>
    @endif
    @endif
 @if($tenant_data->will_expire >= now())
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fas fa-pencil-ruler"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ __('Active Portofolio Theme') }}</h4>
                </div>
                <div class="card-body">
                    <div id="portfolio-theme">
                        <img src="{{ asset('backend/admin/assets/img/loader.gif') }}" height="40" class="loader">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="far fa-address-card"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ __('Active VCard Theme') }}</h4>
                </div>
                <div class="card-body">
                    <div id="vcard-theme">
                        <img src="{{ asset('backend/admin/assets/img/loader.gif') }}" height="40" class="loader">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card card-statistic-1">
            <div class="card-icon bg-info">
                <i class="fas fa-blog"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ __('Total Blogs') }}</h4>
                </div>
                <div class="card-body">
                    <div id="total-blog">
                        <img src="{{ asset('backend/admin/assets/img/loader.gif') }}" height="40" class="loader">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="card card-statistic-1">
            <div class="card-icon bg-dark">
                <i class="fas fa-tasks"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>{{ __('Total Projects') }}</h4>
                </div>
                <div class="card-body">
                    <div id="total-project">
                        <img src="{{ asset('backend/admin/assets/img/loader.gif') }}" height="40" class="loader">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                   @if($tenant_data->qrcode == 1)
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Theme QR Code') }}</h4>
                            </div>
                            <div class="qr-code-fixed-area">
                                <div class="card-body">
                                    <div class="qr-code-main">
                                        <div class="qr-code-main text-center theme_qrcode" id="theme_qrcode">
                                            {!! QrCode::size(300)->generate(env('APP_URL_WITH_TENANT').$tenant_data->id) !!}
                                        </div>
                                    </div>
                                    @if($tenant_data->domainInfo)
                                    <div class="mt-3">
                                        <form action="{{ route('user.dashboard') }}" type="get" class="basicform">
                                            <select class="form-control select_qrcode selectric" name="qrcode" id="select_qrcode">
                                                <option value="{{ env('APP_URL_WITH_TENANT').$tenant_data->id }}">{{ env('APP_URL_WITH_TENANT').$tenant_data->id }}
                                                </option>
                                                @foreach($tenant_data->domainInfo as $key => $value)
                                                <option value="{{ $value->id }}">{{ env('APP_PROTOCOL').$value->domain }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </div>
                                    @else
                                    @endif
                                    <div class="btn-download mt-3">
                                        <a class="btn btn-primary btn-lg w-100" onclick="downloadPng()"
                                            href="javascript:void(0)">{{ __('Download') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('VCard QR Code') }}</h4>
                            </div>
                            <div class="qr-code-fixed-area">
                                <div class="card-body">
                                    <div class="qr-code-main">
                                        <div class="qr-code-main vcard vcard_qrcode text-center" id="vcard_qrcode">
                                            {!! QrCode::size(300)->generate(url(env('APP_URL_WITH_TENANT').$tenant_data->id .'/my-vcard')) !!}
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <form action="{{ route('user.dashboard') }}" type="get">
                                            <select class="form-control select_vcardqrcode selectric" name="vcardqrcode" id="select_vcardqrcode">
                                                <option value="{{ env('APP_URL_WITH_TENANT').$tenant_data->id .'/my-vcard' }}">{{ url(env('APP_URL_WITH_TENANT').$tenant_data->id .'/my-vcard') }}
                                                </option>
                                                @foreach($tenant_data->domain as $key => $value)
                                                @if(parse_url($value->domain, PHP_URL_HOST)==parse_url(env('APP_URL_WITH_TENANT'),
                                                PHP_URL_HOST))
                                                <option value="{{ $value->domain }}">{{ env('APP_PROTOCOL').$value->domain .'my-vcard' }}
                                                </option>
                                                @else
                                                <option value="{{$value->domain }}">
                                                    {{ env('APP_PROTOCOL').$value->domain .'/my-vcard' }}
                                                </option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </form>
                                    </div>
                                    <div class="btn-download mt-3">
                                        <a onclick="downloadVcardPng()" class="btn btn-primary btn-lg w-100"
                                            href="javascript:void(0)">{{ __('Download') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Recent Blogs') }}</h4>
                            </div>
                            <div class="card-body">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                {{ __('SL') }}</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    {{ __('Image') }}</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                {{ __('Name') }}</th>
                                            <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                {{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <input type="hidden" id="blogurl" value="{{ url('/user-blog') }}">
                                    <input type="hidden" id="blogediturl" value="{{ url('user/blog') }}">
                                    <tbody id="recent-blogs"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="float-left">
                                    <h4>{{ __('Copy Your Portfolio URL') }}</h4>
                                </div>
                                <div class="float-right">
                                    
                                </div>
                            </div>
                            <div class="qr-code-fixed-area">
                                <div class="card-body">
                                    <div class="input-group mb-3 copy-url">
                                        <select class="form-control selectric" id="themeUrl" aria-describedby="button-addon1">
                                            <option value="{{ env('APP_URL_WITH_TENANT').$tenant_data->id }}">{{ env('APP_URL_WITH_TENANT').$tenant_data->id }}
                                            </option>
                                            @foreach($tenant_data->domainInfo as $key => $value)
                                            <option value="{{ env('APP_PROTOCOL').$value->domain }}">{{ env('APP_PROTOCOL').$value->domain }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-primary mb-0 btn-lg" onclick="themeUrl()"
                                            id="button-addon1">{{ __('copy') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Copy Your Vcard URL') }}</h4>
                            </div>
                            <div class="qr-code-fixed-area">
                                <div class="card-body">
                                    <div class="input-group mb-3 copy-url">
                                        <select class="form-control selectric" id="vcardUrl" aria-describedby="button-addon1">
                                            <option value="{{ url(env('APP_URL_WITH_TENANT').$tenant_data->id .'/my-vcard') }}">{{ url(env('APP_URL_WITH_TENANT').$tenant_data->id .'/my-vcard') }}
                                            </option>
                                            @foreach($tenant_data->domain as $key => $value)
                                            @if(parse_url($value->domain, PHP_URL_HOST)==parse_url(env('APP_URL_WITH_TENANT'),
                                            PHP_URL_HOST))
                                            <option value="{{ url(env('APP_PROTOCOL').$value->domain .'my-vcard') }}">{{ url(env('APP_PROTOCOL').$value->domain .'my-vcard') }}
                                            </option>
                                            @else
                                            <option value="{{ url(env('APP_PROTOCOL').$value->domain .'/my-vcard') }}">
                                                {{ url(env('APP_PROTOCOL').$value->domain .'/my-vcard') }}
                                            </option>
                                            @endif
                                            @endforeach
                                        </select>
                                        <button class="btn btn-primary mb-0 btn-lg" onclick="vcardUrl()" id="button-addon1">{{ __('copy') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ __('Copy Your CV URL') }}</h4>
                            </div>
                            <div class="qr-code-fixed-area">
                                <div class="card-body">
                                    <div class="input-group mb-3 copy-url">
                                        <select class="form-control selectric" id="cvUrl" aria-describedby="button-addon1">
                                            <option value="{{ url(env('APP_URL_WITH_TENANT').$tenant_data->id .'/my-cv') }}">{{ url(env('APP_URL_WITH_TENANT').$tenant_data->id .'/my-cv') }}
                                            </option>
                                            @foreach($tenant_data->domain as $key => $value)
                                            @if(parse_url($value->domain, PHP_URL_HOST)==parse_url(env('APP_URL_WITH_TENANT'),
                                            PHP_URL_HOST))
                                            <option value="{{ url(env('APP_PROTOCOL').$value->domain .'my-cv') }}">{{ url(env('APP_PROTOCOL').$value->domain .'my-cv') }}
                                            </option>
                                            @else
                                            <option value="{{ url(env('APP_PROTOCOL').$value->domain .'/my-cv') }}">
                                                {{ url(env('APP_PROTOCOL').$value->domain .'/my-cv') }}
                                            </option>
                                            @endif
                                            @endforeach
                                        </select>
                                        <button class="btn btn-primary mb-0 btn-lg" onclick="cvUrl()" id="button-addon1">{{ __('copy') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center justify-content-between w-100">
                                    <h4 >{{ $name }}</h4>
                                    @if (Auth::user()->is_trial == 1)
                                    <a class="btn btn-primary" href="{{ route('user.plan.index') }}">{{ __('Subscribe') }}</a>
                                   
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <td>{{ __('Expire Date') }}</td>
                                        <td class="text-danger">{{  \Carbon\Carbon::parse($tenant_data->will_expire)->format('d-F-Y') }}
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>{{ __('Storage') }}</td>
                                        <td id="storage"><img src="{{ asset('backend/admin/assets/img/loader.gif') }}" height="40"
                                                class="loader"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Posts') }}</td>
                                        <td id="total_posts"><img src="{{ asset('backend/admin/assets/img/loader.gif') }}" height="40"
                                                class="loader"></td>
                                    </tr>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row my-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between w-100">
                     <h4>{{ __('Recent Projects') }}</h4>
                     <a class="btn btn-primary"
                     href="{{ route('user.project.index') }}">{{ __('View All') }}</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                {{ __('SL') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                {{ __('Name') }}</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                {{ __('Link') }}</th>
                            <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                {{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <input type="hidden" id="projectediturl" value="{{ url('user/project') }}">
                    <tbody id="recent-projects"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="dashboardurl" value="{{ route('user.dashboard.stats') }}">
<input type="hidden" id="qrcodeChange" value="{{ route('user.qrcodeChange') }}">
<input type="hidden" id="asset_url" value="{{ asset('/') }}">
@endif
@endsection

@push('js')
<script src="{{ asset('backend/admin/assets/js/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('backend/admin/assets/js/user-dashboard.js') }}"></script>

<script src="{{ asset('backend/admin/assets/js/user-qrcode.js') }}"></script>

@endpush