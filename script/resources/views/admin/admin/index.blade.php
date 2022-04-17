@extends('layouts.backend.app')

@section('title','Manage Admin')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Manage Admin','button_name'=> 'Add New','button_link'=> route('admin.admin.create')])
@endsection

@push('before_css')
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/selectric.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-action-filter">
                <form method="post" id="basicform" action="{{ route('admin.admins.destroy') }}">
                    @csrf
                    <div class="card-header pb-0">
                        @can('role.delete')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="input-group mb-3">
                                    <select class="form-control selectric" name="status">
                                        <option value="">{{ __('Select Action') }}</option>
                                        <option value="1">{{ __('Active') }}</option>
                                        <option value="0">{{ __('Deactivate') }}</option>
                                        <option value="delete">{{ __('Delete Permanently') }}</option>
                                    </select>
                                    <button class="btn btn-primary mb-0 btn-sm text-xs" type="submit"
                                        id="button-addon2">
                                        {{ __('Apply') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr class="text-center">
                                <th class="" width="10%">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input checkAll" id="selectAll">
                                        <label class="custom-control-label checkAll" for="selectAll"></label>
                                    </div>
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('Name') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('Email') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('Phone') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('Status') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('Role') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $row)
                            <tr class="text-center">
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="ids[]" class="custom-control-input"
                                            id="customCheck{{ $row->id }}" value="{{ $row->id }}">
                                        <label class="custom-control-label" for="customCheck{{ $row->id }}"></label>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $row->name }} </p>
                                    @can('admin.edit')
                                    <div class="hover text-xs font-weight-bold mb-0">
                                        <a href="{{ route('admin.admin.edit',$row->id) }}">{{ __('Edit') }}</a>
                                    </div>
                                    @endcan
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $row->email }} </p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $row->phone }}</p>
                                </td>
                                <td class="align-middle text-center text-xs">
                                    @if($row->status==1)
                                    <span class="badge badge-primary">{{ __('Active') }}</span>
                                    @else
                                    <span class="badge badge-danger">{{ __('Deactive') }}</span>
                                    @endif
                                </td>
                                <td>
                                    @foreach($row->roles as $r) <p class="text-xs font-weight-bold mb-0">{{ $r->name }}
                                    </p>@endforeach
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('backend/admin/assets/js/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('backend/admin/assets/js/selectric.js') }}"></script>
@endpush