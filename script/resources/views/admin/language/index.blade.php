@extends('layouts.backend.app')

@section('title','Manage Language')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Manage Language','button_name'=>'Add New','button_link'=> route('admin.language.create')])
@endsection

@push('before_css')
<link rel="stylesheet" href="{{ asset('backend/admin/assets/css/selectric.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <form action="{{ route('admin.language.set') }}" method="POST" class="basicform">
                @csrf
                @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="input-group mb-3">
                                <select class="form-control selectric" name="status" aria-describedby="button-addon2">
                                    <option value="">{{ __('Select Option') }}</option>
                                    <option value="active">{{ __('Active Language') }}</option>
                                </select>
                                <button class="btn btn-primary mb-0 btn-sm text-xs" type="submit"
                                    id="button-addon2">
                                    {{ __('Apply') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input checkAll" id="selectAll">
                                            <label class="custom-control-label checkAll" for="selectAll"></label>
                                        </div>
                                    </th>
                                    <th>
                                        {{ __('Language Key') }}</th>
                                    <th>
                                        {{ __('Language Name') }}</th>
                                    <th>
                                        {{ __('Action') }}</th>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach($languages as $key=>$language)
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="lang_id[]"
                                            {{ $language->status == 1 ? 'checked' : '' }}
                                            value="{{ $language->id }}">
                                        <label for="checkbox-{{ $key }}" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $language->name }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $language->data }}</p>
                                </td>
                            </form>
                                <td class="align-middle">
                                    <a class="btn btn-primary text-light px-3 mb-0" href="{{ route('admin.language.edit',$language->id) }}"><i
                                            class="fas fa-pencil-alt text-light mr-2" aria-hidden="true"></i>{{ __('Edit') }}</a>
                                    <a class="btn btn-danger px-3 mb-0 delete-confirm" href="javascript:void(0)"
                                        data-id={{ $language->id }}><i class="far fa-trash-alt mr-2"
                                            aria-hidden="true"></i>{{ __('Delete') }}</a>
                                    <form class="d-none" id="delete_form_{{ $language->id }}"
                                        action="{{ route('admin.language.destroy', $language->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                {{ $languages->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection

@push('js')
<script src="{{ asset('backend/admin/assets/js/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('backend/admin/assets/js/admin-delete.swal.js') }}"></script>
@endpush