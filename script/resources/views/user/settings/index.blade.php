@extends('layouts.backend.app')

@push('css')
<link rel="stylesheet" href="{{ asset('backend/admin/assets/css/font-awesome-5.15.3-css-all.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/admin/assets/css/bootstrap-iconpicker.min.css') }}">
@endpush

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Settings'])
@endsection

@section('content')
<div class="col-12">
  <div class=" mb-4">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-12 col-sm-12 col-md-3">
                <ul class="nav nav-pills flex-column" id="myTab4" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active"  id="profile-tab4" data-toggle="tab" href="#home4" role="tab" aria-controls="profile" aria-selected="false" >{{ __('Domain') }}</a>
                  </li>
                </ul>
              </div>
              <div class="col-12 col-sm-12 col-md-9">
                <div class="tab-content no-padding" id="myTab2Content">
                  <div class="tab-pane fade show active" id="home4" role="tabpanel" aria-labelledby="home-tab4">
                    <div class="row">
                      <div class="col-12">
                        <div class="container-fluid">
                          <div class="row ">
                            <div class="col-12 col-lg-12">
                              <div class="card card-secondary">
                                <div class="card-header">
                                  <h4>{{ __('Subdomain') }}</h4>
                                  <div class="card-header-action">
                                    <a href="#" class="btn btn-success btn-lg" data-toggle="modal" data-target="#subdomain"><i class="{{ !empty($domainInfo->subdomain) ? 'fa fa-edit' : 'fas fa-plus-circle' }}"></i></a>
                                    @if(!empty($domainInfo->subdomain))
                                     <form class="d-none" id="delete_form_{{ $domainInfo->subdomain->id }}"
                                    action="{{ route('user.subdomain.destroy', $domainInfo->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    </form>
                                    <a href="#" class="btn btn-danger delete-confirm" data-id={{ $domainInfo->subdomain->id }}><i class="fa fa-trash"></i></a>

                                    @endif
                                  </div>
                                </div>
                                <div class="card-body">
                                  @if(!empty($domainInfo->subdomain))
                                  <p> {{ $domainInfo->subdomain->domain ?? '' }}</p>
                                  @if($domainInfo->subdomain->status == 1)
                                  <span class="badge badge-success">{{ __('Connected') }} </span>
                                  @elseif($domainInfo->subdomain->status == 2)
                                  <span class="badge badge-warning">{{ __('Pending') }}   </span>
                                  @else
                                  <span class="badge badge-danger">{{ __('Disabled') }}   </span>
                                  @endif
                                  @endif

                                </div>
                              </div>
                              <div class="card card-secondary">
                                <div class="card-header">
                                  <h4>{{ __('Custom domain') }}</h4>
                                  <div class="card-header-action">
                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#createModal"><i class="{{ !empty($domainInfo->customdomain) ? 'fa fa-edit' : 'fas fa-plus-circle' }}"></i></a>

                                    @if(!empty($domainInfo->customdomain))
                                    <form class="d-none" id="delete_form_{{ $domainInfo->customdomain->id }}"
                                    action="{{ route('user.customdomain.destroy', $domainInfo->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <a href="#" class="btn btn-danger delete-confirm" data-id={{ $domainInfo->customdomain->id }}><i class="fa fa-trash"></i></a>

                                    @endif
                                  </div>
                                </div>
                                <div class="card-body">
                                  @if(!empty($domainInfo->customdomain))
                                  <p> {{ $domainInfo->customdomain->domain ?? '' }}</p>
                                  @if($domainInfo->customdomain->status == 1)
                                  <span class="badge badge-success">{{ __('Connected') }} </span>
                                  @elseif($domainInfo->customdomain->status == 2)
                                  <span class="badge badge-warning">{{ __('Pending') }}   </span>
                                  @else
                                  <span class="badge badge-danger">{{ __('Disabled') }}   </span>
                                  @endif
                                  @endif

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="profile4" role="tabpanel" aria-labelledby="profile-tab4">
                   b
                 </div>
                 <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">

                 </div>
               </div>
             </div>

           </div>
         </div>

       </div>
     </div>
   </div>
 </div>
</div>

@if(!empty($domainInfo))
@if($domainInfo->sub_domain == 1)
@if(empty($domainInfo->subdomain))
<!-- Modal -->
<div class="modal fade" id="subdomain" tabindex="-1" aria-labelledby="subdomain" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subdomain">{{ __('Add Subdomain') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form class="basicform_with_reload" action="{{ route('user.subdomain.store',$domainInfo->id) }}">
                @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label>{{ __('Add new subdomain') }}</label>
                    <div class="form-group">
                      <div class="input-group mb-2">
                        <input type="text" class="form-control text-right" name="subdomain" placeholder="enter shop name" value="{{ $domainInfo->id }}">
                        <div class="input-group-append">
                          <div class="input-group-text">.{{ env('APP_PROTOCOLESS_URL') }}</div>
                        </div>
                      </div>
                      <small class="form-text">{{ __('Example:') }} {example}.{{ env('APP_PROTOCOLESS_URL') }}</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="submit" class="btn btn-primary basicbtn">{{ __('Connect') }}</button>
            </div>
            </form>
        </div>
    </div>
</div>
@else
<!-- Modal -->
<div class="modal fade" id="subdomain" tabindex="-1" aria-labelledby="subdomain" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subdomain">{{ __('Edit Subdomain') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form class="basicform_with_reload" action="{{ route('user.subdomain.update',$domainInfo->id) }}">
                @csrf
                @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label>{{ __('Add new subdomain') }}</label>
                    <div class="form-group">
                      <div class="input-group mb-2">
                        <input type="text" class="form-control text-right" name="subdomain" placeholder="enter shop name" value="{{ str_replace('.'.env('APP_PROTOCOLESS_URL'), '', $domainInfo->subdomain->domain) }}">
                        <div class="input-group-append">
                          <div class="input-group-text">.{{ env('APP_PROTOCOLESS_URL') }}</div>
                        </div>
                      </div>
                      <small class="form-text">{{ __('Example:') }} {example}.{{ env('APP_PROTOCOLESS_URL') }}</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="submit" class="btn btn-primary basicbtn">{{ __('Connect') }}</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endif
@endif
@endif

@if(!empty($domainInfo))
@if($domainInfo->custom_domain == 1)
@if(empty($domainInfo->customdomain))
<div class="modal fade" tabindex="-1" id="createModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" class="basicform_with_reload" accept-charset="UTF-8" action="{{ route('user.custom-domain.store',$domainInfo->id) }}">
                @csrf
                <div class="modal-card card">
                    
                    <div class="modal-header">
                        <h5 class="modal-title" id="customdomain">{{ __('Add existing domain') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                    <div class="card-body">
                        <div id="form-errors"></div>
                        <div class="form-group">
                            <label>{{ __('Custom domain') }}</label>
                            <input class="form-control" autofocus="" name="domain" type="text" placeholder="example.com" required="">
                            <small class="form-text text-muted">{{ __('Enter the domain you want to connect.') }}</small>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Configure your DNS records') }}</label>
                            <small class="form-text text-muted">{{ $dns->dns_configure_instruction ?? '' }}</small>
                            <table class="table table-nowrap card-table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Type') }}</th>
                                        <th>{{ __('Record') }}</th>
                                        <th>{{ __('Value') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ __('A') }}</td>
                                        <td>&nbsp;</td>
                                        <td>{{ env('SERVER_IP') }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('CNAME') }}</td>
                                        <td>{{ __('www') }}</td>
                                        <td>{{ env('CNAME_DOMAIN') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <small class="form-text text-muted">{{ $dns->support_instruction ?? '' }}</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-primary basicbtn" data-style="expand-left" data-loading-text="Verify..."><span class="ladda-label">{{ __('Connect') }}</span><span class="ladda-spinner"></span></button>
                </div>
            </form>
        </div>
    </div>
</div>

@else
<div class="modal fade" tabindex="-1" id="createModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" class="basicform_with_reload" accept-charset="UTF-8" action="{{ route('user.custom-domain.update',$domainInfo->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-card card">
                    
                    <div class="modal-header">
                        <h5 class="modal-title" id="customdomain">{{ __('Add existing domain') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                    <div class="card-body">
                        <div id="form-errors"></div>
                        <div class="form-group">
                            <label>{{ __('Custom domain') }}</label>
                            <input class="form-control" autofocus="" name="domain" type="text" placeholder="example.com" required="" value="{{ $domainInfo->customdomain->domain ?? '' }}">
                            <small class="form-text text-muted">{{ __('Enter the domain you want to connect.') }}</small>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Configure your DNS records') }}</label>
                            <small class="form-text text-muted">{{ $dns->dns_configure_instruction ?? '' }}</small>
                            <table class="table table-nowrap card-table">
                                <thead>
                                    <tr>
                                        <th>{{ __('Type') }}</th>
                                        <th>{{ __('Record') }}</th>
                                        <th>{{ __('Value') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ __('A') }}</td>
                                        <td>&nbsp;</td>
                                        <td>{{ env('SERVER_IP') }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('CNAME') }}</td>
                                        <td>{{ __('www') }}</td>
                                        <td>{{ env('CNAME_DOMAIN') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <small class="form-text text-muted">{{ $dns->support_instruction ?? '' }}</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="submit" class="btn btn-primary basicbtn" data-style="expand-left" data-loading-text="Verify..."><span class="ladda-label">{{ __('Connect') }}</span><span class="ladda-spinner"></span></button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endif
@endif
@endsection