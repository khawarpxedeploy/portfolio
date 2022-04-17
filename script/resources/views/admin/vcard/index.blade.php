@extends('layouts.backend.app')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Vcards'])
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
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#exampleModal">
                        {{ __('Add New') }}
                    </button>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('SL') }}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('Name') }}</th>
                                <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('View Path') }}</th>
                                <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{ __('Asset Path') }}</th>
                                <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        {{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($theme ?? [] as $key=> $value)
                            <tr>
                                <td>
                                   <img src="{{ asset($value->asset_path.'/screenshot.png') }}" height="50">
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $value->name ?? '' }}</p>
                                </td>

                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $value->view_path ?? '' }}</p>
                                </td>

                                <td>
                                    <p class="text-xs font-weight-bold mb-0">{{ $value->asset_path ?? ''}}</p>
                                </td>

                                <td>
                                    <a class="btn btn-danger px-3 mb-0 delete-confirm"
                                        href="javascript:void(0)" data-id={{ $value->id }}><i
                                            class="far fa-trash-alt mr-2" aria-hidden="true"></i>Delete</a>
                                    <form class="d-none" id="delete_form_{{ $value->id }}"
                                        action="{{ route('admin.vcard.destroy', $value->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="p-4">
                        {{ $theme->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __('Upload New Vcard Theme
            ') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form action="{{ route('admin.vcard.store') }}" class="basicform">
        @csrf
       
        <div class="modal-body">
          <label for="file">{{ __('Select File') }}</label>
          <input type="file" class="form-control" name="file">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
          <button type="submit" class="btn btn-primary basicbtn">{{ __('Submit') }}</button>
        </div>
        </form>
      </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('backend/admin/assets/js/admin-delete.swal.js') }}"></script>
@endpush