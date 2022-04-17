@extends('layouts.backend.app')

@section('title','Edit Testimonial')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Edit Testimonial','prev'=> route('user.testimonial.index')])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ __('Edit Testimonial') }}</h4>
            </div>
            <form method="POST" action="{{ route('user.testimonial.update',$testimonial->id) }}"
                enctype="multipart/form-data" class="basicform_with_reload">@csrf
                @method('PUT')
                @php
                $data = json_decode($testimonial->testimonial_meta->value);
                @endphp
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>{{ __('Whoops!') }}</strong>{{__(' There were some problems with your input.')}}<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="form-group row mb-4">
                        <label class="text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <img src="{{ asset($data->avatar) }}" alt="image"
                                height="100">
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Avatar') }}</label>
                        <div class="col-sm-12 col-md-7"><input type="file" class="form-control"
                                name="avatar" /></div>
                    </div>
                    <div class="form-group row mb-4">
                        <label
                            class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Client Name') }}</label>
                        <div class="col-sm-12 col-md-7"><input type="text" class="form-control"
                                name="client_name" value="{{ old('client_name')?? $testimonial->name }}" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Position') }}</label>
                        <div class="col-sm-12 col-md-7"><input type="text" class="form-control" required=""
                                name="position" value="{{ old('position')??$data->position }}" /></div>
                    </div>
                    <div class="form-group row mb-4">
                        <label
                            class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Review message') }}</label>
                        <div class="col-sm-12 col-md-7"><textarea  class="form-control" required=""
                                name="review"  />{{ $data->review }}</textarea> </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button class="btn btn-primary basicbtn btn-lg w-100"
                                type="submit">{{ __('Update') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection