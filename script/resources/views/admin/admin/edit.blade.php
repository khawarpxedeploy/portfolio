@extends('layouts.backend.app')

@section('title','Edit Admin')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Edit Admin Information','button_name'=>'Manage List','button_link'=> route('admin.admin.index')])
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('backend/admin/assets/css/select2.min.css') }}">
@endpush

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
                <form method="post" action="{{ route('admin.admin.update',$user->id) }}" class="basicform_with_reload">
                    @csrf
                    @method('PUT')
                    <div>
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" value="{{ $user->name }}" required class="form-control" name="name"
                                placeholder="{{ __('Enter admin name') }}">
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" value="{{ $user->email }}" required class="form-control" name="email"
                                placeholder="{{ __('Enter email') }}">
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('Phone') }}</label>
                            <input type="number" value="{{ $user->phone }}" required class="form-control" name="phone"
                                placeholder="{{ __('Enter phone') }}">
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input type="password" class="form-control" name="password"
                                placeholder="{{ __('Enter password') }}">
                        </div>
                        <div class="form-group">
                            <label for="password">{{ __('Confirm Password') }}</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="{{ __('Confirmation password') }}">
                        </div>

                        <div class="form-group">
                            <label for="roles">{{ __('Assign Roles') }}</label>
                            <select required name="roles[]" id="roles" class="form-control select2" multiple>
                                @foreach ($roles as $role)
                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                    {{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Status') }}</label>
                            <select name="status" class="form-control">
                                <option value="1" @if($user->status==1) selected @endif>{{ __('Active') }}</option>
                                <option value="0" @if($user->status==0) selected @endif>{{ __('Deactive') }}</option>
                            </select>
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
@endsection

@push('js')
<script src="{{ asset('backend/admin/assets/js/select2.min.js') }}"></script>
@endpush