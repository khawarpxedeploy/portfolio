@extends('layouts.backend.app')

@section('title','Create Testimonial')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Create Testimonial','prev'=> route('user.testimonial.index')])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ __('Create Testimonial') }}</h4>
            </div>
            <form method="POST" action="{{ route('user.testimonial.store') }}" enctype="multipart/form-data"
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
                    <div class="form-group row mb-4">
                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Avatar') }}</label>
                        <div class="col-sm-12 col-md-7"><input type="file" class="form-control" required=""
                                name="avatar" /></div>
                    </div>
                    <div class="form-group row mb-4">
                        <label
                            class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Client Name') }}</label>
                        <div class="col-sm-12 col-md-7"><input type="text" class="form-control" required=""
                                name="client_name" /></div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Position') }}</label>
                        <div class="col-sm-12 col-md-7"><input type="text" class="form-control" required=""
                                name="position" /></div>
                    </div>
                    <div class="form-group row mb-4">
                        <label
                            class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Review message') }}</label>
                        <div class="col-sm-12 col-md-7"><textarea class="form-control" name="review"></textarea></div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button class="btn btn-primary basicbtn btn-lg w-100" type="submit">{{ __('Save') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection