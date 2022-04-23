@extends('layouts.backend.app')

@section('title','Edit Project')



@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Edit Project','prev'=> route('user.project.index')])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form method="POST" action="{{ route('user.project.update',$data->id) }}"
                            enctype="multipart/form-data" class="basicform">
                            @csrf
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
                                <div class="form-group row mb-4">
                                    <label
                                        class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Project Image') }}</label>
                                    <div class="col-sm-12 col-md-7"><input type="file" class="form-control"
                                            name="image" /></div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Prev photo') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <img class="mt-2" src="{{ asset($data->thum_image->value ?? null) }}"
                                            alt="Project Image" height="50">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label
                                        class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Project Title') }}</label>
                                    <div class="col-sm-12 col-md-7"><input type="text" class="form-control" required=""
                                            name="title" value="{{ old('title')??$data->title }}" /></div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label
                                        class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Project Link') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" required="" name="link"
                                            value="{{ old('link')??$data->link->value }}" />
                                    </div>
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
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('backend/admin/assets/js/select2.min.js') }}"></script>
@endpush