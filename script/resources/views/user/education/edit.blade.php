@extends('layouts.backend.app')

@section('title','Edit Education')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Edit Education','prev'=> route('user.education.index')])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>{{ __('Edit Education') }}</h4>
            </div>
            <form method="POST" action="{{ route('user.education.update',$data->id) }}"
                enctype="multipart/form-data" class="basicform">
                @csrf
                @method('PUT')
                @php $val = json_decode($data->education_meta->value); @endphp
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
                            class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Starting Date') }}</label>
                        <div class="col-sm-12 col-md-7"><input type="date" class="form-control" required=""
                                value="{{ old('starting_date') ??$val->starting_date }}"
                                name="starting_date" /></div>
                    </div>
                    <div class="form-group row mb-4">
                        <label
                            class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Ending Date') }}</label>
                        <div class="col-sm-12 col-md-7"><input type="date" class="form-control" 
                                name="ending_date" value="{{ old('ending_date')??$val->ending_date }}" />
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Subject') }}</label>
                        <div class="col-sm-12 col-md-7"><input type="text" class="form-control" required=""
                                name="subject" value="{{ old('subject')??$val->subject }}" /></div>
                    </div>
                    <div class="form-group row mb-4">
                        <label
                            class="text-md-right col-12 col-md-3 col-lg-3">{{ __('School / University') }}</label>
                        <div class="col-sm-12 col-md-7"><input type="text" class="form-control" required=""
                                name="university" value="{{ old('university')??$val->university }}" /></div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Short Content') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <textarea name="short_content" class="form-control" cols="30" rows="10">{{ $val->short_content ?? '' }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button class="btn btn-primary btn-lg w-100 basicbtn" type="submit">{{ __('Update') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection