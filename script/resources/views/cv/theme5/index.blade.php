@extends('cv.theme5.layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('cv/theme5/css/style.css') }}">
@endpush

@section('content')
<!-- main area start -->
<section>
    <div class="main-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="main-page-section" id="element-to-print">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="header-main-section text-center" style="background:{{ $data->mode == 'dark' ? '#434343' : $data->color }}">
                                    <div class="header-data">
                                        <h2>{{ $data->name ?? '' }}</h2>
                                        <p>{{ $data->role ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="main-body-area">
                            <div class="row">
                                <div class="col-lg-8 right-border">
                                    <div class="single-section">
                                        <div class="single-title">
                                            <h4>{{ cvtitle('About Me') }}</h4>
                                        </div>
                                        <div class="single-des">
                                            <p>{{ $data->about }}</p>
                                        </div>
                                    </div>
                                    <div class="single-section">
                                        <div class="single-title">
                                            <h4>{{ cvtitle('Experience') }}</h4>
                                        </div>
                                        @foreach ($data->experience ?? [] as $item)
                                        <div class="single-des experience">
                                            <h6>{{ $item->role ?? ''}} | {{ $item->duration ?? ''}}</h6>
                                            <h6>{{ $item->company ?? ''}}</h6>
                                            <p>{{ $item->description ?? ''}}</p>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="single-section">
                                        <div class="single-title">
                                            <h4>{{ cvtitle('Contact') }}</h4>
                                        </div>
                                        <div class="single-des">
                                            @foreach ($data->contact ?? [] as $key => $item)
                                            <div class="contact"><strong>{{ ucwords($item->key) ?? '' }}: </strong>{{ $item->value ?? '' }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="single-section">
                                        <div class="single-title">
                                            <h4>{{ cvtitle('Skills') }}</h4>
                                        </div>
                                        <div class="single-des">
                                            <ul>
                                                @foreach ($data->skill ?? [] as $item)
                                                    <li>{{ $item ??''}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="single-section">
                                        <div class="single-title">
                                            <h4>{{ cvtitle('Education') }}</h4>
                                        </div>
                                        @foreach ($data->education ?? [] as $item)
                                        <div class="single-des">
                                            <div class="single-education">
                                                <div class="education-name">
                                                    <h5>{{ $item->institute ?? ''}}</h5>
                                                </div>
                                                <div class="education-year">
                                                    <p>{{ $item->duration ?? ''}}</p>
                                                </div>
                                                <div class="degree-name">
                                                    <p>{{ $item->degree ?? ''}}</p>
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
