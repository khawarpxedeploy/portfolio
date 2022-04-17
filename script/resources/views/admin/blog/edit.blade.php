@extends('layouts.backend.app')

@push('css')
<link rel="stylesheet" href="{{ asset('backend/admin/assets/css/summernote/summernote-bs4.css') }}">
@endpush

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Edit Blog','prev'=>route('admin.blog.index')])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form method="POST" action="{{ route('admin.blog.update',$data->id) }}"
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
                                        class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Privew Image') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <img src="{{ asset($data->thum_image->value) }}" alt=""
                                            class="image-thumbnail blog-img">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Image') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label
                                        class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Short Description') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="excerpt" cols="30" rows="10"
                                            class="form-control">{{ $data->excerpt->value }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label
                                        class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Description') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="description" cols="30" rows="10"
                                            class="summernote form-control">{{ $data->description->value }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Status') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="status" class="form-control">
                                            <option value="1" {{$data->status == 1 ? 'selected':""}}>{{ __('Active') }}
                                            </option>
                                            <option value="0" {{$data->status == 0 ? 'selected':""}}>
                                                {{ __('Deactive') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary w-100 btn-lg" type="submit">{{ __('Update') }}</button>
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