@extends('layouts.backend.app')

@section('title','Create New CV Language')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Create New CV language','button_name'=>'Manage CV Languages','button_link'=> route('admin.cvlanguage.index')])
@endsection

@push('before_css')
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/selectric.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>{{ __('woops!') }}</strong> {{ __('There were some problems with your input.') }}<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="{{ route('admin.cvlanguage.store') }}" class="basicform_with_reset">
                @csrf
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <label class="text-md-right col-12 col-md-3 col-lg-3">{{ __('Select language') }}</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="name" class="form-control selectric">
                                @foreach ($langlist as $cvlanguage)
                                <option value="{{ $cvlanguage['code'] }}">{{ $cvlanguage['name'].' -- '.$cvlanguage['nativeName'].' -- ' }} ({{ $cvlanguage['code'] }})</option>
                                @endforeach
                            </select>
                        </div>
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

@push('js')
<script src="{{ asset('backend/admin/assets/js/jquery.selectric.min.js') }}"></script>
@endpush
