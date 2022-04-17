@extends('layouts.backend.app')

@section('title','Manage Menu')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Manage Menu'])
@endsection

@push('before_css')
<link rel="stylesheet" href="{{ asset('backend/admin/assets/css/selectric.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <form class="basicform_with_reload" method="post" action="{{ route('admin.menu.store') }}">
                    @csrf
                    <div class="form-group">
                        <label>{{ __('Menu Name') }} <sup>*</sup></label>
                        <input type="text" id="name" class="form-control" name="name" placeholder="Menu Name">
                    </div>
                    <div class="form-group">
                        <label>{{ __('Menu Position') }} <sup>*</sup></label>
                        <select class="form-control selectric" name="position">
                            <option value="header">{{ __('Header') }}</option>
                            <option value="footer_left">{{ __('Footer Left') }}</option>
                            <option value="footer_right">{{ __('Footer Right') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Select Language') }} <sup>*</sup></label>
                        <select class="form-control selectric" name="lang">
                            @foreach($langs as $row)
                            <option value="{{ $row->name }}">{{ $row->data }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{ __('Menu Status') }} <sup>*</sup></label>
                        <select class="form-control selectric" name="status">
                            <option value="1">{{ __('Active') }}</option>
                            <option value="0" selected="">{{ __('Draft') }}</option>
                        </select>
                    </div>
                    <button class="btn btn-primary basicbtn btn-lg w-100" type="submit">{{ __('Add New Menu') }}</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-md-12 d-flex align-items-center text-xxs">
                        <form class="basicform_with_reload" method="post" action="{{ route('admin.menus.destroy') }}">
                            @csrf
                            <div class="input-group mb-3">
                                <select class="form-control selectric" name="method" aria-describedby="button-addon2">
                                    <option value="">{{ __('Select Actions') }}</option>
                                    <option value="delete">{{ __('Delete Permanently') }}</option>
                                </select>
                                <button class="btn btn-primary mb-0 btn-sm text-xs" type="submit"
                                    id="button-addon2">
                                    {{ __('Apply') }}
                                </button>
                            </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input checkAll" id="checkAll">
                                        <label class="custom-control-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('Postion') }}</th>
                                <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('Language') }}</th>
                                <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('Status') }}</th>
                                <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('Customize') }}</th>
                                <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Models\Menu::latest()->get() as $menu)
                            <tr>
                                <td>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="ids[]" class="custom-control-input"
                                            id="customCheck{{ $menu->id }}" value="{{ $menu->id }}">
                                        <label class="custom-control-label" for="customCheck{{ $menu->id }}"></label>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $menu->position }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $menu->lang }}
                                    </p>
                                </td>
                                <td>
                                    @if($menu->status==1)
                                    <p class="badge badge-primary">
                                        {{ __('Active Menu') }}</p>

                                    @else <p class="badge badge-danger">
                                        {{ __('Draft Menu') }}</p>
                                    @endif
                                </td>

                                <td><a href="{{ route('admin.menu.show',$menu->id) }}" class="text-xs"><i
                                            class="fas fa-arrows-alt"></i> {{ __('Customize') }}</a></td>

                                <td><a class="text-xs text-dark" href="{{ route('admin.menu.edit',$menu->id) }}"><i
                                            class="fas fa-pencil-alt text-light mr-2"></i>{{ __('Edit') }}</a>
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
@endpush