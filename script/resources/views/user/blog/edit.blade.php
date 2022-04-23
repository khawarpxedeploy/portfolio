@extends('layouts.backend.app')

@section('title','Edit Blog')

@push('before_css')
<link rel="stylesheet" href="{{ asset('backend/admin/assets/css/summernote/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{ asset('backend/admin/assets/css/select2.min.css') }}">
@endpush

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Blog
Edit','prev'=> route('user.blog.index')])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form method="POST" action="{{ route('user.blog.update',$data->id) }}"
                            enctype="multipart/form-data" class="basicform">
                            @method('PUT')
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
                                <div class="form-group row mb-4">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Title') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" id="name" class="form-control" name="name"
                                            value="{{old('name') ? old('name') :$data->title}}">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Preview Image') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <img class="blog-img" height="100" src="{{ asset($data->thum_image->value) }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Image') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" id="image" class="form-control" name="image">
                                    </div>
                                </div>

                               

                                <div class="form-group row mb-4">
                                    <label
                                        class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Short Content') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="excerpt" cols="30" rows="10"
                                            class="form-control">{{ $data->excerpt->value }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label
                                        class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Description') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="description"
                                            class="summernote form-control" id="summernote">{{ $data->description->value }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary basicbtn btn-lg w-100" type="submit">{{ __('Update') }}</button>
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

@if(env('CONTENT_EDITOR') == true)
@push('js')
<script src="{{ asset('backend/admin/assets/js/summernote-bs4.js') }}"></script>
<script src="{{ asset('backend/admin/assets/js/admin-summernote.js') }}"></script>
@endpush
@endif
@push('js')
    <script src="{{ asset('backend/admin/assets/js/select2.min.js') }}"></script>
@endpush