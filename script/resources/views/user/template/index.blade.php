@extends('layouts.backend.app')

@section('title','All Themes -')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'All Themes'])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
            @endif
            <div class="card-body">
                <div class="row mt-5">
                    @foreach ($theme ?? [] as $key=> $value)
                        <div class="col-lg-4">
                            <div class="card">
                                @if ($value->asset_path)
                                <div class="theme-card">
                                    <img class="theme-thumbnail" src="{{ asset($value->asset_path) }}/screenshot.png" alt="{{ $value->name }}">
                                </div>
                                @endif
                                <div class="card-body text-center mt-0 pt-0">
                                    <hr class="horizontal dark my-3">
                                    <h5 class="mb-0">
                                        <form class="basicform_with_reload" action="{{ route('user.template.store') }}" method="POST">
                                            @csrf 
                                            <input type="hidden" name="theme" value="{{ $value->view_path }}">
                                            <button class="w-100 btn btn-{{ $tenant ? ($tenant->theme == $value->view_path ? 'danger' : 'primary') : '' }} btn-lg" type="submit" {{ $tenant ? ($tenant->theme == $value->view_path ?'disabled' : '') : '' }}>{{ $tenant ? ($tenant->theme == $value->view_path ? 'Installed' : 'Install') : 'Install' }}</button>
                                        </form>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('backend/admin/assets/js/admin-delete.swal.js') }}"></script>
@endpush