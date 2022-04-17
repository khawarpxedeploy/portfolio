@extends('layouts.backend.app')

@section('title','Edit CV Language')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Edit CV language','button_name'=>'Manage CV Language','button_link'=> route('admin.cvlanguage.index')])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-md-6 d-flex align-items-center">
                        <h6 class="mb-0">{{ __('Edit Langauage') }}</h6>
                    </div>
                    <div class="col-md-6 text-right text-xxs">
                        <a class="btn btn-primary mb-0 text-xxs"
                            href="{{ route('admin.cvlanguage.index') }}">&nbsp;&nbsp;{{ __('Manage CV language') }}</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="row">
                                    <div class="col-md-8">
                                        <form action="{{ route('admin.cvlanguage.update', $id) }}" method="POST" class="langform basicform">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="lang" value="{{ $name }}">
                                                @php $info = json_decode($data) @endphp
                                                @foreach($info->$name ?? [] as $key => $value)
                                                <div class="row mb-4">
                                                    <div class="col-md-6">
                                                        <label class="h-100 d-flex justify-content-end align-items-center font-weight-bolder text-sm"> {{ $key }}</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div>
                                                            <input type="text" name="{{ $name }}[{{ $key }}]" value="{{ $value ?? $key }}" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="submit" class="btn btn-primary btn-lg w-100">{{ __('Submit') }}</button>
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
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('backend/admin/assets/js/admin-language-edit.js') }}"></script>
@endpush