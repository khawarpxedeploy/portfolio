@extends('layouts.backend.app')

@section('title','Manage Page')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Pages','button_name'=>'Add New','button_link'=> route('admin.page.create')])
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
                <h4>{{ __('Manage Page') }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase">
                                {{ __('SL') }}</th>
                                <th class="text-uppercase">
                                {{ __('Name') }}</th>
                                <th class="text-uppercase">
                                {{ __('Url') }}</th>
                                <th class=" text-uppercase">
                                {{ __('Status') }}</th>
                                <th class=" text-uppercase">
                                {{ __('Created At') }}</th>
                                <th class=" text-uppercase">
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
                                    <p class="">{{ $i++ }}</p>
                                </td>
                                <td>
                                    <p class="">{{ $item->title }}</p>
                                </td>
                                <td>
                                    <p class="">{{ url('/page',$item->slug) }}</p>
                                </td>
                                <td class="align-middle text-sm">
                                    @if($item->status == 1)
                                    <span class="badge badge-sm badge-success">{{ __('Active') }}</span>
                                    @else
                                    <span class="badge badge-sm badge-danger">{{ __('Inactive') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <p class="">
                                        {{ date('d-m-Y', strtotime($item->created_at)) }}</p>
                                    </td>
                                    <td >
                                        <div class="dropdown d-inline">
                                          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ __('Edit') }}
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item has-icon" href="{{ route('admin.page.edit',$item->id) }}"><i class="far fa-edit"></i> {{ __('Edit') }}</a>
                                            <a class="dropdown-item has-icon  delete-confirm"  href="javascript:void(0)" data-id={{ $item->id }}><i class="fa fa-trash-alt"></i> {{ __('Delete') }}</a>
                                            
                                            <form class="d-none" id="delete_form_{{ $item->id }}"
                                                action="{{ route('admin.page.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </div>
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