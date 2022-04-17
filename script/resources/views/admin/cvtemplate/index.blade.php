@extends('layouts.backend.app')

@section('title','CV Tamplates')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'CV Tamplates'])
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-body">
                @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif
                <div class="row">
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-4 text-right">
                        <button class="btn btn-primary m-3" data-toggle="modal" data-target="#exampleModal">{{ __('Upload Theme') }}</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table" id="table-2">
                        <thead>
                            <tr>
                                <th>{{ __('SL') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('View Path') }}</th>
                                <th>{{ __('Asset Path') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($theme ?? [] as $key=> $value)
                            <tr>
                                <td><img src="{{ asset($value->asset_path.'/img/screenshot.png') }}" height="50"></td>
                                <td>{{ $value->name ?? '' }}</td>
                                <td>{{ $value->view_path ?? '' }}</td>
                                <td>{{ $value->asset_path ?? ''}}</td>
                                <td>
                                    <a class="btn btn-danger text-gradient px-3 mb-0 delete-confirm"
                                        href="javascript:void(0)" data-id={{ $value->id }}><i
                                            class="far fa-trash-alt mr-2" aria-hidden="true"></i>Delete</a>
                                    <form class="d-none" id="delete_form_{{ $value->id }}"
                                        action="{{ route('admin.cvtemplate.destroy', $value->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4">
                    {{ $theme->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Upload New Theme
                    ') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.cvtemplate.store') }}" class="basicform">
                    @csrf
                   
                    <div class="modal-body">
                        <label for="file">{{ __('Select File') }}</label>
                        <input type="file" class="form-control" name="file">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary basicbtn">{{ __('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
