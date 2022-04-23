@extends('layouts.backend.app')

@section('title','Create New Plan')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Create New Plan','prev'=>
route('admin.plan.index')])
@endsection

@push('before_css')
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/selectric.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <form method="POST" action="{{ route('admin.plan.store') }}" class="basicform_with_reload">
                @csrf
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
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12 ">
                            <div class="form-group">
                                <label>{{ __('Title') }} <sup>*</sup></label>
                                <input type="text" id="name" class="form-control" name="name">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12 ">
                            <div class="form-group">
                                <label>{{ __('Duration') }} <sup>*</sup></label>
                                <input type="number" id="duration" class="form-control" name="duration">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>{{ __('Storage Size') }}<sup>*</sup></label>
                                <input type="number" step="any" class="form-control" name="storage_size">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>{{ __('Price') }} <sup>*</sup></label>
                                <input type="number" step="any" id="price" class="form-control" name="price">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>{{ __('Post Limit') }} <sup>*</sup></label>
                                <input type="number" class="form-control" name="postlimit">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>{{ __('Portfolio Builder') }} <sup>*</sup></label>
                                <select class="form-control selectric" name="portfolio_builder">
                                    <option value="1">{{ __('Yes') }}</option>
                                    <option value="0">{{ __('No') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>{{ __('Custom Domain') }} <sup>*</sup></label>
                                <select class="form-control selectric" name="custom_domain">
                                    <option value="1">{{ __('Yes') }}</option>
                                    <option value="0">{{ __('No') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>{{ __('Sub Domain') }} <sup>*</sup></label>
                                <select class="form-control selectric" name="sub_domain">
                                    <option value="1">{{ __('Yes') }}</option>
                                    <option value="0">{{ __('No') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>{{ __('QR Code') }} <sup>*</sup></label>
                                <select class="form-control selectric" name="qrcode">
                                    <option value="1">{{ __('Yes') }}</option>
                                    <option value="0">{{ __('No') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>{{ __('Vcard') }} <sup>*</sup></label>
                                <select class="form-control selectric" name="vcard">
                                    <option value="1">{{ __('Yes') }}</option>
                                    <option value="0">{{ __('No') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>{{ __('Online CV') }} <sup>*</sup></label>
                                <select class="form-control selectric" name="online_cv">
                                    <option value="1">{{ __('Yes') }}</option>
                                    <option value="0">{{ __('No') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>{{ __('Resume Builder') }} <sup>*</sup></label>
                                <select class="form-control selectric" name="resume_builder">
                                    <option value="1">{{ __('Yes') }}</option>
                                    <option value="0">{{ __('No') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>{{ __('Is Featured') }} <sup>*</sup></label>
                                <select class="form-control selectric" name="is_featured">
                                    <option value="1">{{ __('Yes') }}</option>
                                    <option value="0">{{ __('No') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>{{ __('Status') }}</label>
                                <select name="status" class="form-control selectric">
                                    <option value="1">{{ __('Active') }}</option>
                                    <option value="0">{{ __('Deactive') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                   
                   
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary basicbtn w-100 btn-lg">{{ __('Submit') }}</button>
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