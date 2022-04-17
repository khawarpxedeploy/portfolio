@extends('cv.theme2.layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('cv/theme2/css/style1.css') }}">
@endpush

@section('content')
<section>
    <div class="main-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="cv-templates-area" id="element-to-print">
                        <div class="row layout" style="background:{{ $data->mode == 'dark' ? '#434343' : "" }}">
                            <div class="col-lg-4 sidebar" style="background:{{ $data->mode == 'dark' ? '#434343' : $data->color }}">
                                <div class="sidebar-section">
                                    <div class="user-info text-center">
                                        <div class="user-name">
                                            @php $name = explode(" ",$data->name) @endphp
                                            <h2>{{ $name[0] ?? 'John' }} <br> <span
                                                    class="last-name">{{ $name[1] ?? 'Doe' }}</span></h2>
                                        </div>
                                        <div class="user-position">
                                            <p>{{ $data->role }}</p>
                                        </div>
                                        <div class="user-img">
                                            <img src="{{ asset($data->image ?? '') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="sidebar-card">
                                        <div class="sidebar-card-header text-center">
                                            <h4>{{ cvtitle('Education') }}</h4>
                                        </div>
                                        <div class="sidebar-card-body">
                                            @foreach ($data->education ?? [] as $item)
                                                <div class="education-main-area">
                                                    <div class="education-title">
                                                        <h6>{{ $item->degree }}</h6>
                                                    </div>
                                                    <div class="university-name">
                                                        <p>{{ $item->institute }}</p>

                                                    </div>
                                                    <div class="university-year">
                                                        <span>{{ $item->duration }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="sidebar-card">
                                        <div class="sidebar-card-header text-center">
                                            <h4>{{ cvtitle('Skills') }}</h4>
                                        </div>
                                        <div class="sidebar-card-body">
                                            <div class="skill-lists">
                                                <ul>
                                                    @foreach ($data->skill ?? [] as $item)
                                                        <li>{{ $item }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sidebar-card">
                                        <div class="sidebar-card-header text-center">
                                            <h4>{{ cvtitle('References') }}</h4>
                                        </div>
                                        <div class="sidebar-card-body">
                                            <div class="skill-lists">
                                                <ul> 
                                                    @foreach ($data->reference ?? [] as $item)
                                                    <li>
                                                        <h5>{{ $item->name }}</h5>
                                                        <span>{{ $item->role }}</span>
                                                        <div><span><strong>Phone: </strong>{{ $item->phone ?? ''}}</span></div>
                                                        <div><span><strong>Email: </strong>{{ $item->email ?? '' }}</span></div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="resume-card">
                                    <div class="resume-card-header">
                                        <h4>{{ cvtitle('About Me') }}</h4>
                                    </div>
                                    <div class="resume-card-body">
                                        <p>{{ $data->about }}</p>
                                        <div class="resume-table">
                                            {{ $data->address }}
                                        </div>
                                    </div>
                                </div>
                                @if (isset($data->contact) && count($data->contact) > 0)
                                <div class="resume-card">
                                    <div class="resume-card-header">
                                        <h4>{{ cvtitle('Contact') }}</h4>
                                    </div>
                                    <div class="resume-card-body">
                                        <div class="resume-table">
                                            <ul>
                                                
                                            </ul>
                                            @foreach ($data->contact ?? [] as $key => $item)
                                            <li><span class="iconify"
                                                        data-icon="{{ getVcardIcon(ucwords($item->key)) }}"
                                                        data-inline="false"></span>
                                                    {{ $item->value ?? '' }}
                                                </li>

                                            @endforeach 
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="resume-card">
                                    <div class="resume-card-header">
                                        <h4>{{ cvtitle('Experience') }}</h4>
                                    </div>
                                    <div class="resume-card-body">
                                        <div class="resume-table">
                                            @foreach ($data->experience ?? [] as $key => $item)
                                                <h3>{{ $item->company ?? '' }}</h3>
                                                <p>{{ $item->role ?? '' }}</p>
                                                <p>@php 
                                                    $type = [
                                                        1 => 'Part Time',
                                                        2 => 'Full Time',
                                                        3 => 'Contract',
                                                        4 => 'Student',
                                                        0 => '',
                                                    ][$item->type];
                                                    @endphp
                                                    <span class="iconify"
                                                        data-icon="{{ getVcardIcon('company') }}"
                                                        data-inline="false"></span>
                                                    {{ $type ?? '' }}
                                                </p>
                                                <p>{{ $item->duration ?? '' }}</p>
                                                <p>{{ $item->description ?? '' }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="resume-card">
                                    <div class="resume-card-header">
                                        <h4>{{ cvtitle('Accomplishments') }}</h4>
                                    </div>
                                    <div class="resume-card-body">
                                        <div class="resume-table">
                                            @foreach ($data->accomplishment ?? [] as $key => $item)
                                            <h3>{{ $item->duration ?? '' }}</h3>
                                            <h5>{{ $item->description ?? '' }}</h5>
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
@endsection

