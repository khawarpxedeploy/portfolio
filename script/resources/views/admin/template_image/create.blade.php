@extends('layouts.backend.app')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Create New Template Showcase','prev'=>route('admin.template-image.index') ])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form method="POST" action="{{ route('admin.template-image.store') }}"
                            enctype="multipart/form-data" class="basicform_with_reset">@csrf
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
                                <div class="form-group row ">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Link') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" id="title" class="form-control" name="link">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Image') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" id="image" class="form-control" name="image">
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Type') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control" name="type">
                                            <option value="portfolio_template">{{ __('Portfolio Template') }}</option>
                                            <option value="resume_template">{{ __('Resume Template') }}</option>
                                            <option value="vcard_template">{{ __('VCard Template') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Is Featured') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control" name="featured">
                                            <option value="1">{{ __('Yes') }}</option>
                                            <option value="0" selected="">{{ __('No') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary w-100 btn-lg" type="submit">{{ __('Submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection