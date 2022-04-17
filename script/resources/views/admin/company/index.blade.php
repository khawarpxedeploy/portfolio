@extends('layouts.backend.app')

@section('title','Manage Company')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Manage Company','button_name'=>'Create New','button_link'=> route('admin.company.create')])
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
                <h4>{{ __('Manage Company') }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase">
                                    {{ __('SL') }}</th>
                                <th><i class="fa fa-image"></i></th>
                                <th class="text-uppercase">
                                    {{ __('Name') }}</th>
                                <th class="text-uppercase">
                                    {{ __('Link') }}</th>
                                <th class=" text-uppercase">
                                    {{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key=> $item)
                            @php $value = json_decode($item->value); @endphp
                            <tr>
                                <td>
                                    <p>{{ $key +1 }}</p>
                                </td>
                                <td><img src="{{ asset($value->image) }}" height="30"></td>
                                <td>
                                    <p>{{ $value->name }}</p>
                                </td>
                                <td>
                                    <p>{{ $value->link }}</p>
                                </td>
                                <td>
                                    <a class="btn btn-primary text-light px-3 mb-0"
                                        href="{{ route('admin.company.edit',$item->id) }}"><i
                                            class="fas fa-pencil-alt text-light mr-2" aria-hidden="true"></i>Edit</a>
                                    <a class="btn btn-danger px-3 mb-0 delete-confirm"
                                        href="javascript:void(0)" data-id={{ $item->id }}><i
                                            class="far fa-trash-alt mr-2" aria-hidden="true"></i>Delete</a>
                                    <form class="d-none" id="delete_form_{{ $item->id }}"
                                        action="{{ route('admin.company.destroy', $item->id) }}" method="POST">
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