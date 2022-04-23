@extends('layouts.backend.app')

@section('title','Manage Benefit')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Benefit Table','button_name'=>'Add
New','button_link'=> route('admin.benefit.create')])
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
                <h4>{{ __('Manage Benefit') }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase">
                                    {{ __('SL') }}</th>
                                <th class="text-uppercase">
                                    {{ __('title') }}</th>
                                <th class=" text-uppercase">
                                    {{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key=> $item)
                            @php
                            $value = json_decode($item->value);
                            @endphp
                            <tr>
                                <td>
                                    <p class="">{{ $key +1 }}</p>
                                </td>
                                <td>
                                    <p class="">{{ $value->title }}</p>
                                </td>
                                <td>
                                    <a class="btn btn-primary text-light px-3 mb-0"
                                        href="{{ route('admin.benefit.edit',$item->id) }}"><i
                                            class="fas fa-pencil-alt text-light mr-2"
                                            aria-hidden="true"></i>{{ __('Edit') }}</a>
                                    <a class="btn btn-danger px-3 mb-0 delete-confirm"
                                        href="javascript:void(0)" data-id={{ $item->id }}><i
                                            class="far fa-trash-alt mr-2" aria-hidden="true"></i>{{ __('Delete') }}</a>
                                    <form class="d-none delete_basicform" id="delete_form_{{ $item->id }}"
                                        action="{{ route('admin.benefit.destroy', $item->id) }}" method="POST">
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