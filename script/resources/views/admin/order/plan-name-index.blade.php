@extends('layouts.backend.app')

@section('title','Plan Table')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Plan Table','button_name'=> 'All
Order','button_link'=>
route('admin.order.index')])
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
                <h6>{{ $planName->name }}{{ ' Plan Table' }}</h6>
                <div class="table-responsive">
                    <table class="table" id="table-2">
                        <thead>
                            <tr>
                                <tr>
                                    <th>{{ __('SL') }}</th>
                                    <th>{{ __('User') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Getway') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </tr>
                        </thead>
                        <tbody>@foreach ($planOrder ?? [] as $order)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $order->user->name }}
                                </td>

                                <td>
                                    {{ $order->price }}
                                </td>
                                <td>
                                    {{ $order->getway->name }}
                                </td>
                                <td class="align-middle text-sm">
                                    @php
                                    $status = [
                                    0 => ['class' => 'danger', 'text' => 'Rejected'],
                                    1 => ['class' => 'primary', 'text' => 'Accepted'],
                                    3 => ['class' => 'danger', 'text' => 'Expired'],
                                    2 => ['class' => 'warning', 'text' => 'Pending'],
                                    4 => ['class' => 'danger', 'text' => 'Trash'],
                                    ][$order->status];
                                    @endphp
                                    <span class="badge badge-{{ $status['class'] }}">{{ $status['text'] }}</span>
                                </td>
                                <td>
                                    <button class="btn btn-primary dropdown-toggle" type="button"
                                        id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        {{ __('Action') }}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item has-icon"
                                            href="{{ route('admin.order.edit',$order->id) }}"><i
                                                class="fa fa-eye"></i>{{ __('Edit') }}</a>
                                        <a class="dropdown-item has-icon"
                                            href="{{ route('admin.order.show',$order->id) }}"><i
                                                class="fas fa-eye"></i>{{ __('View') }}</a>
                                        <a class="dropdown-item has-icon delete-confirm" href="javascript:void(0)"
                                            data-id={{ $order->id }}><i class="fa fa-trash"></i>{{ __('Delete') }}</a>
                                        <!-- Delete Form -->
                                        <form class="d-none" id="delete_form_{{ $order->id }}"
                                            action="{{ route('admin.order.destroy', $order->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $planOrder->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection