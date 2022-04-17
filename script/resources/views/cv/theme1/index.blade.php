@extends('cv.theme1.layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('cv/theme1/css/style.css') }}">
@endpush

@section('content')
<!-- main area start -->
<section>
    <div class="main-area">
        <div class="container">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cv-templates-area" >
                        <div class="row layout" style="background:{{ $data->mode == 'dark' ? '#434343' : "" }}">
                            <div class="col-lg-4 sidebar" style="background:{{ $data->mode == 'dark' ? '#434343' : $data->color }}">
                                <div class="single-sidebar">
                                    <div class="user-img text-center">
                                        <img src="{{ asset($data->image ?? '') }}" alt="">
                                    </div>
                                    <div class="user-info-area">
                                        <div class="info-header">
                                            <h4>{{ cvtitle('About Me') }}</h4>
                                        </div>
                                        <div class="info-body">
                                            <div class="single-info">
                                                <div class="info-icon">
                                                    <span class="iconify" data-icon="ant-design:user-outlined" data-inline="false"></span>
                                                </div>
                                                <div class="info-data">
                                                    <h5>{{ __('Name') }}</h5>
                                                    <span>{{ $data->name ?? '' }}</span>
                                                </div>
                                            </div>
                                           
                                                <div class="single-info">
                                                    <div class="info-icon">
                                                        <span class="iconify" data-icon="akar-icons:location" data-inline="false"></span>
                                                    </div>
                                                    <div class="info-data">
                                                        <h5>{{ __('Address') }}</h5>
                                                        <span>{{ $data->address ?? '' }}</span>
                                                    </div>
                                                </div>
                                         
                                            
                                                <div class="single-info">
                                                    <div class="info-icon">
                                                        <span class="iconify" data-icon="feather:mail" data-inline="false"></span>
                                                    </div>
                                                    <div class="info-data">
                                                        <h5>{{ __('Email') }}</h5>
                                                        <span>
                                                            @foreach ($data->contact ?? [] as $item)
                                                                @if ($item->key == 'email')
                                                                    @php $email = $item->value @endphp
                                                                @else 
                                                                    @php $email = $user->email @endphp
                                                                @endif
                                                            @endforeach   
                                                            {{ $email ?? '' }} 
                                                        </span>
                                                    </div>
                                                </div>
                                         

                                            
                                                <div class="single-info">
                                                    <div class="info-icon">
                                                        <span class="iconify" data-icon="akar-icons:link-chain" data-inline="false"></span>
                                                    </div>
                                                    <div class="info-data">
                                                        <h5>{{ __('Website') }}</h5>
                                                        <span>
                                                        @foreach ($data->contact ?? [] as $item)
                                                            @if ($item->key == 'website')
                                                            {{ $item->value }} 
                                                            @endif
                                                        @endforeach 
                                                    </span>
                                                    </div>
                                                </div>
                                         
                                        </div>
                                    </div>
                                    <div class="user-info-area">
                                        <div class="info-header">
                                            <h4>{{ cvtitle('Social') }}</h4>
                                        </div>
                                        <div class="info-body">
                                            @foreach ($data->contact ?? [] as $item)
                                            @if ($item->key != 'website' && $item->key != 'email')
                                        
                                                <div class="single-info">
                                                    <div class="info-icon">
                                                        <span class="iconify" data-icon="{{ getVcardIcon(ucwords($item->key)) }}" data-inline="false"></span>
                                                    </div>
                                                    <div class="info-data">
                                                        <h5>{{ ucwords($item->key) }}</h5>
                                                        <span>{{ $item->value ?? '' }}</span>
                                                    </div>
                                                </div>
                                           
                                            @endif
                                            @endforeach 
                                        </div>
                                    </div>
                                    <div class="user-info-area">
                                        <div class="info-header">
                                            <h4>{{ cvtitle('References') }}</h4>
                                        </div>
                                        <div class="info-body">
                                            @foreach ($data->reference ?? [] as $item)
                                            
                                                <div class="single-info">
                                                    <div class="info-icon">
                                                        <span class="iconify" data-icon="dashicons:admin-links" data-inline="false"></span>
                                                    </div>
                                                    <div class="info-data">
                                                        <h5>{{ $item->name }}</h5>
                                                        <p>{{ $item->role }}</p>
                                                        <div><span><strong>Phone: </strong>{{ $item->phone ?? ''}}</span></div>
                                                        <div><span><strong>Email: </strong>{{ $item->email ?? ''}}</span></div>
                                                    </div>
                                                </div>
                                          
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="template-right-section">
                                    <div class="user-area">
                                        <div class="user-name">
                                            <h2>{{ $data->name ?? '' }}</h2>
                                            <p>{{ $data->role  ?? ''}}</p>
                                        </div>
                                    </div>
                                    <div class="eduction-area">
                                        <div class="education-header">
                                            <h4>{{ cvtitle('Education') }}</h4>
                                        </div>
                                        <div class="education-body">
                                            @foreach ($data->education ?? [] as $item)
                                            <div class="single-education">
                                                <div class="education-title">
                                                    <h6>{{ $item->degree ?? ''}}</h6>
                                                </div>
                                                <div class="university-name">
                                                    <h3>{{ $item->institute ?? ''}}</h3>
                                                </div>
                                                <div class="passed-year">
                                                    <span>{{ $item->duration ?? ''}}</span>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="eduction-area">
                                        <div class="education-header">
                                            <h4>{{ cvtitle('Experience') }}</h4>
                                        </div>
                                        <div class="education-body">
                                            @foreach ($data->experience ?? [] as $item)
                                            <div class="single-education">
                                                <div class="education-title">
                                                    <h6>{{ $item->company ?? ''}}</h6>
                                                </div>
                                                <div class="university-name">
                                                    <h3>{{ $item->role ?? ''}}</h3>
                                                </div>
                                                <div class="passed-year mb-2">
                                                    <span>{{ $item->duration ?? ''}}</span>
                                                </div>
                                                <div class="education-des">
                                                    <p>{{ $item->description ?? ''}}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="eduction-area">
                                        <div class="education-header">
                                            <h4>{{ cvtitle('Skills') }}</h4>
                                        </div>
                                        <div class="education-body">
                                            @foreach ($data->skill ?? [] as $item)
                                            <div class="single-education">
                                                <div class="university-name">
                                                    <h5>{{ $item ??''}}</h5>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="eduction-area">
                                        <div class="education-header">
                                            <h4>{{ cvtitle('Accomplishments') }}</h4>
                                        </div>
                                        <div class="education-body">
                                            @foreach ($data->accomplishment ?? [] as $key => $item)
                                            <div class="single-education">
                                                <div class="education-title">
                                                    <h6>{{ $item->duration ?? '' }}</h6>
                                                </div>
                                                <div class="education-des">
                                                    <p>{{ $item->description ?? '' }}</p>
                                                </div>
                                            </div>
                                            @endforeach
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
</section>
<!-- main area end -->
@endsection
