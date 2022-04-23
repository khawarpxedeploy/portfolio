@extends('layouts.backend.app')

@section('title','Manage Service')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Manage Service','button_name'=>'Create New','button_link'=> route('user.service.create')])
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
            <div class="card-header">
                <h4>{{ __('Manage Service') }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('SL') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('Image') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('Name') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('Created At') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = ($data->currentpage()-1)* $data->perpage() + 1
                            @endphp
                            @foreach ($data as $item)
                            <tr>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $i++ }}</p>
                                </td>
                                <td><img class="blog-img" src="{{ asset($item->thum_image->value ?? '') }}" alt=""></td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ Str::limit($item->title,20) }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $item->created_at->toDateString() }}</p>
                                </td>
                                <td>
                                    <a class="btn btn-primary text-light px-3 mb-0"
                                        href="{{ route('user.service.edit',$item->id) }}"><i
                                            class="fas fa-pencil-alt text-light mr-2"
                                            aria-hidden="true"></i>{{ __('Edit') }}</a>
                                    <a class="btn btn-danger px-3 mb-0 delete-confirm"
                                        href="javascript:void(0)" data-id={{ $item->id }}><i
                                            class="far fa-trash-alt mr-2" aria-hidden="true"></i>{{ __('Delete') }}</a>
                                    <form class="d-none" id="delete_form_{{ $item->id }}"
                                        action="{{ route('user.service.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('backend/admin/assets/js/admin-delete.swal.js') }}"></script>
@endpush