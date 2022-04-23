@extends('layouts.backend.app')

@section('title','Template Images')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Template Image'])
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
                <div class="d-flex align-items-center justify-content-between w-100">
                    <h4>{{ __('Template Image') }}</h4>
                    <a href="{{ route('admin.template-image.create') }}" class="btn btn-primary btn-lg">Add New</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th>
                                    {{ __('SL') }}</th>
                                <th>
                                    {{ __('link') }}</th>
                                <th>
                                    {{ __('Image') }}</th>
                                <th>
                                    {{ __('Type') }}</th>
                                <th >
                                    {{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key=> $item)
                            <tr>
                                <td>
                                    <p>{{ $key +1 }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->slug }}</p>
                                </td>
                                <td>
                                  <img src="{{ asset($item->title) }}" height="50">
                                </td>
                                <td>
                                    <p>{{ str_replace('_',' ',$item->type) }}</p>
                                </td>
                                <td>
                                    <a class="btn btn-primary text-light px-3 mb-0"
                                        href="{{ route('admin.template-image.edit',$item->id) }}"><i
                                            class="fas fa-pencil-alt text-light mr-2" aria-hidden="true"></i>{{ __('Edit') }}</a>
                                    <a class="btn btn-danger px-3 mb-0 delete-confirm"
                                        href="javascript:void(0)" data-id={{ $item->id }}><i
                                            class="far fa-trash-alt mr-2" aria-hidden="true"></i>{{ __('Delete') }}</a>
                                    <form class="d-none" id="delete_form_{{ $item->id }}"
                                        action="{{ route('admin.template-image.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('backend/admin/assets/js/admin-delete.swal.js') }}"></script>
@endpush