@extends('layouts.backend.app')

@section('title','Manage Role')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Manage Role','button_name'=>'Add New','button_link'=>route('admin.role.create')])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-action-filter">
                <form method="post" class="basicform_with_reload" action="{{ route('admin.roles.destroy') }}">
                    @csrf
                    <div class="card-header pb-0">
                        @can('role.delete')
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="input-group mb-3">
                                    <select class="form-control selectric" name="status">
                                        <option value="">{{ __('Select Action') }}</option>
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
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center" width="10%">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input checkAll" id="selectAll">
                                            <label class="custom-control-label checkAll" for="selectAll"></label>
                                        </div>
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        {{ __('Name') }}</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        {{ __('Permissions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $page)
                                <tr>
                                    <th class="text-center">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="ids[]" class="custom-control-input"
                                                id="customCheck{{ $page->id }}" value="{{ $page->id }}">
                                            <label class="custom-control-label" for="customCheck{{ $page->id }}"></label>
                                        </div>
                                    </th>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $page->name }}</p>

                                        <div class="hover text-xs font-weight-bold mb-0">
                                            <a href="{{ route('admin.role.edit',$page->id) }}">{{ __('Edit') }}</a>
                                        </div>
                                    </td>
                                    <td>
                                        @foreach ($page->permissions as $perm)
                                        <p class="badge badge-primary text-xs font-weight-bold mb-0">
                                            {{ $perm->name }}</p>
                                        @endforeach
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
</div>
@endsection