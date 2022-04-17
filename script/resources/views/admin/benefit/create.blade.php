@extends('layouts.backend.app')

@section('title','Create Benefit')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Create Benefit','prev'=>route('admin.benefit.index')])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Create Benefit') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.benefit.store') }}" enctype="multipart/form-data"
                            class="basicform_with_reset">@csrf
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
                                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Title') }}</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" id="title" class="form-control" name="title">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Image') }}</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="file" id="image" class="form-control" name="image">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label
                                            class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Short Content') }}</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea name="excerpt" cols="30" rows="10" class="form-control"></textarea>
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
</div>
@endsection