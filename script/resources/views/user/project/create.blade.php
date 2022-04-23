@extends('layouts.backend.app')
@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Project Create','prev'=> route('user.project.index')])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Project Create') }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('user.project.store') }}"
                            class="basicform_with_reset">
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
                                    <label
                                        class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Project Image') }}</label>
                                    <div class="col-sm-12 col-md-7"><input type="file" class="form-control" required=""
                                            name="image" /></div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label
                                        class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Project Title') }}</label>
                                    <div class="col-sm-12 col-md-7"><input type="text" class="form-control" required=""
                                            name="title" /></div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label
                                        class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Project Link') }}</label>
                                    <div class="col-sm-12 col-md-7"><input type="text" class="form-control" required=""
                                            name="link" /></div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-primary basicbtn w-100 btn-lg" type="submit">{{ __('Save') }}</button>
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
