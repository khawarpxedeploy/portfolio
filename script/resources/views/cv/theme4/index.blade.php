@extends('cv.theme4.layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('cv/theme4/css/style.css') }}">
@endpush

@section('content')
<!-- main area start -->
<section>
    <div class="main-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="main-page-area" id="element-to-print">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="resume-header-section text-center">
                                    <div class="user-name">
                                        <h4>{{ $data->name ?? '' }}</h4>
                                    </div>
                                    <div class="user-position">
                                        <p>{{ $data->role ?? '' }}</p>
                                    </div>
                                    <div class="user-image">
                                        <img src="{{ asset($user->image ?? '') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-6 border-right">
                                <div class="cv-left-section f-right">
                                    <div class="cv-header-section">
                                        <h5>{{ cvtitle('Experience') }}</h5>
                                        @foreach ($data->experience ?? [] as $item)
                                        <div class="single-experience">
                                            <p>{{ $item->duration ?? ''}}</p>
                                            <div class="company-name">
                                                <h3>{{ $item->company ?? ''}}</h3>
                                            </div>
                                            <div class="company-position">
                                                <p>{{ $item->role ?? ''}}</p>
                                            </div>
                                            <div class="company-des">
                                                <p>{{ $item->description ?? ''}}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="cv-right-section f-left">
                                    <div class="cv-header-section">
                                        <h5>{{ cvtitle('Education') }}</h5>
                                        @foreach ($data->education ?? [] as $item)
                                        <div class="single-experience">
                                            <p>{{ $item->duration ?? ''}}</p>
                                            <div class="company-name">
                                                <h3>{{ $item->degree ?? ''}}</h3>
                                            </div>
                                            <div class="company-des">
                                                <p>{{ $item->institute ?? ''}}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                        <div class="skills-area">
                                            <h5>{{ cvtitle('Skills') }}</h5>
                                            <div class="skill-lists">
                                                <nav>
                                                    <ul>
                                                        @foreach ($data->skill ?? [] as $item)
                                                        <li>{{ $item ??''}}</li>
                                                        @endforeach
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                        <div class="skills-area">
                                            <h5>{{ cvtitle('Contact') }}</h5>
                                            <div class="skill-lists">
                                                @foreach ($data->contact ?? [] as $key => $item)
                                                <p>{{ ucwords($item->key) ?? '' }}: {{ $item->value ?? '' }}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="referrence-title text-center">
                                    <h5>{{ cvtitle('References') }}</h5>
                                </div>
                                <div class="referrence-area">
                                    <div class="row">
                                        @foreach ($data->reference ?? [] as $item)
                                        <div class="col-lg-4">
                                            <div class="single-referrence text-center">
                                                <div class="user-info">
                                                    <h5>{{ $item->name }}</h5>
                                                    <p>{{ $item->role }}</p>
                                                    <p>T: {{ $item->phone ?? ''}}</p>
                                                    <p>Email: {{ $item->email ?? ''}}</p>
                                                </div>
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
</section>
<!-- main area end -->
@endsection
