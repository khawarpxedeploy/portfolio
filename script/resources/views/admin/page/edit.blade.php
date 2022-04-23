@extends('layouts.backend.app')

@section('title','Edit Page')

@push('css')
<link rel="stylesheet" href="{{ asset('backend/admin/assets/css/summernote/summernote-bs4.css') }}">
@endpush

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'List','prev'=> route('admin.page.index')])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="mb-4">
            <div class="col-12">
                <div class="card">
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
                    <form method="POST" action="{{ route('admin.page.update',$data->id) }}"
                        enctype="multipart/form-data" class="basicform">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="form-group row mb-4">
                                <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Title') }}</label>
                                <div class="col-sm-12 col-md-7">
                                    <input type="text" class="form-control" name="title"
                                        value="{{old('title') ? old('title') :$data->title}}">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Short Description') }}</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea name="excerpt"
                                        class="form-control">{{ $data->excerpt->value ?? null }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Description') }}</label>
                                <div class="col-sm-12 col-md-7">
                                    <textarea name="description" cols="30" rows="10"
                                        class="summernote form-control" id="summernote">{{ $data->description->value ?? null }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Status') }}</label>
                                <div class="col-sm-12 col-md-7">
                                    <select name="status" class="form-control">
                                        <option value="1" {{$data->status == 1 ? 'selected':""}}>{{ __('Active') }}
                                        </option>
                                        <option value="0" {{$data->status == 0 ? 'selected':""}}>{{ __('Deactive') }}
                                        </option>
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
@endsection
@if(env('CONTENT_EDITOR') == true)
@push('js')
<script src="{{ asset('backend/admin/assets/js/summernote-bs4.js') }}"></script>
<script src="{{ asset('backend/admin/assets/js/admin-summernote.js') }}"></script>
@endpush
@endif