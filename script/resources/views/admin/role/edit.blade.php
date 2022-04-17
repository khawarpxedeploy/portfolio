@extends('layouts.backend.app')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Edit Role & Permissions','button_name'=>'Manage Role','button_link'=>route('admin.role.index')])
@endsection

@section('content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>{{ __('Whoops!') }}</strong> {{ __('There were some problems with your input.') }}<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="post" action="{{ route('admin.role.update',$role->id) }}" class="basicform_with_reload">
                    @csrf
                    @method('PUT')
                    <div class="pt-20">
                        <div class="form-group">
                            <label for="name">{{ __('Role Name') }}</label>
                            <input type="text" required class="form-control" name="name" placeholder="Enter role name"
                                value="{{ $role->name }}">
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input checkAll" id="selectAll">
                                    <label class="custom-control-label checkAll"
                                        for="selectAll">{{ __('Permissions') }}</label>
                                </div>
                                <hr>
                                @php $i = 1 @endphp
                                @foreach ($permission_groups as $group)
                                <div class="row">
                                    @php
                                    $permissions = App\Models\User::getpermissionsByGroupName($group->name);
                                    $j = 1
                                    @endphp
                                    <div class="col-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="{{ $i }}Management"
                                                value="{{ $group->name }}"
                                                onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)"
                                                {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="checkPermission">{{ $group->name }}</label>
                                        </div>
                                    </div>
                                    <div class="col-9 role-{{ $i }}-management-checkbox">
                                        @foreach ($permissions as $permission)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input"
                                                onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management', {{ count($permissions) }})"
                                                name="permissions[]"
                                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                id="checkPermission{{ $permission->id }}"
                                                value="{{ $permission->name }}">
                                            <label class="form-check-label"
                                                for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                        </div>
                                        @php $j++ @endphp
                                        @endforeach
                                        <br>
                                    </div>
                                </div>
                                @php $i++ @endphp
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="single-area">
                <div class="card">
                    <div class="card-body">
                        <div class="btn-publish">
                            <button type="submit" class="btn btn-primary col-12 basicbtn"><i class="fa fa-save"></i>
                                {{ __('Update') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('js')
<script src="{{ asset('backend/admin/assets/js/roles.js') }}"></script>
@endpush