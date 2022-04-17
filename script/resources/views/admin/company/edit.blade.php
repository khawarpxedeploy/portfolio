@extends('layouts.backend.app')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Edit New Company','prev'=> route('admin.company.index')])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form method="POST" action="{{ route('admin.company.update',$data->id) }}"
                            enctype="multipart/form-data" class="basicform_with_reload">@csrf
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
                                <div class="form-group row ">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Name') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" id="title" class="form-control" name="name"
                                            value="{{ old('name') ?? $value->name }}">
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Link') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" id="title" class="form-control" name="link"
                                            value="{{ old('link') ?? $value->link }}">
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
                                        class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Preview Image') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <img src="{{ asset($value->image) }}" alt="tamplate image" class="blog-img">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary btn-lg w-100" type="submit">{{ __('Update') }}</button>
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