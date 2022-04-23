@extends('layouts.backend.app')

@section('title','Create New Skill')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Create New Skill','button_name'=>'Manage Skills','button_link'=> route('user.skill.index')])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <form method="POST" action="{{ route('user.skill.store') }}" enctype="multipart/form-data"
                class="basicform_with_reset">
                @csrf
                <div class="card-header">
                    <h4>{{ __('Create New Skill') }}</h4>
                </div>
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
                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Skill Name') }}</label>
                        <div class="col-sm-12 col-md-7"><input type="text" id="name" class="form-control"
                                name="name"></div>
                    </div>
                    <div class="form-group row mb-4">
                        <label
                            class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Expert level (percent)') }}</label>
                        <div class="col-sm-12 col-md-7"><input type="number" id="level" class="form-control"
                                name="level" max="100"></div>
                    </div>
                    <div class="form-group row mb-4">
                        <label
                            class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Frontend View Color') }}</label>
                        <div class="col-sm-12 col-md-7"><input type="color" id="color" class="form-control"
                                name="color"></div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7 text-center">
                            <button type="submit" class="btn btn-primary btn-lg w-100 basicbtn">{{ __('Submit') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection