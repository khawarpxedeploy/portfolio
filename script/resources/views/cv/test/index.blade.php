@extends('cv.test.layouts.app')
@push('css')
<link rel="stylesheet" href="{{ asset('cv/test/css/style.css') }}">
@endpush
@section('content')
<!-- main area start -->
<section>
    <div class="main-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center my-3">
                    <button class="btn btn-primary mr-2" id="download">Download</button>
                    <a class="btn btn-secondary" href="{{ Auth::check() ? route('user.cv.builder') : route('/') }}">Back</a>
                </div>
                <div class="col-lg-10 offset-lg-1">
                    <div class="cv-templates-area" id="element-to-print">
                        <div class="row layout" style="background:{{ $data->mode == 'dark' ? '#434343' : "" }}">
                            <div class="col-lg-4 sidebar" style="background:{{ $data->mode == 'dark' ? '#434343' : $data->color }}">
                                <div class="single-sidebar">
                                    <div class="user-img text-center">
                                        <img src="{{ asset($user->image ?? '') }}" alt="">
                                    </div>
                                    <div class="user-info-area">
                                        <div class="info-header">
                                            <h4>{{ cvtitle('About Me') }}</h4>
                                        </div>
                                        <div class="info-body">
                                            <a href="#">
                                                <div class="single-info">
                                                    <div class="info-icon">
                                                        <span class="iconify" data-icon="ant-design:user-outlined" data-inline="false"></span>
                                                    </div>
                                                    <div class="info-data">
                                                        <h5>Name</h5>
                                                        <span>{{ $data->name ?? '' }}</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="single-info">
                                                    <div class="info-icon">
                                                        <span class="iconify" data-icon="akar-icons:location" data-inline="false"></span>
                                                    </div>
                                                    <div class="info-data">
                                                        <h5>Address</h5>
                                                        <span>{{ $data->address ?? '' }}</span>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="single-info">
                                                    <div class="info-icon">
                                                        <span class="iconify" data-icon="feather:mail" data-inline="false"></span>
                                                    </div>
                                                    <div class="info-data">
                                                        <h5>Email</h5>
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
                                            </a>

                                            <a href="#">
                                                <div class="single-info">
                                                    <div class="info-icon">
                                                        <span class="iconify" data-icon="akar-icons:link-chain" data-inline="false"></span>
                                                    </div>
                                                    <div class="info-data">
                                                        <h5>Website</h5>
                                                        <span>
                                                        @foreach ($data->contact ?? [] as $item)
                                                            @if ($item->key == 'website')
                                                            {{ $item->value }} 
                                                            @endif
                                                        @endforeach 
                                                    </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="user-info-area">
                                        <div class="info-header">
                                            <h4>{{ cvtitle('Social') }}</h4>
                                        </div>
                                        <div class="info-body">
                                            @foreach ($data->contact ?? [] as $item)
                                            @if ($item->key != 'website' && $item->key != 'email')
                                            <a href="#">
                                                <div class="single-info">
                                                    <div class="info-icon">
                                                        <span class="iconify" data-icon="{{ getVcardIcon(ucwords($item->key)) }}" data-inline="false"></span>
                                                    </div>
                                                    <div class="info-data">
                                                        <h5>{{ ucwords($item->key) }}</h5>
                                                        <span>{{ $item->value ?? '' }}</span>
                                                    </div>
                                                </div>
                                            </a> 
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
                                            <a href="#">
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
                                            </a>
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

@push('js')
<script>
    var element = document.getElementById('element-to-print');
    var opt = {
                margin: 0,
                filename: 'unique.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 4
                },
                jsPDF: {
                    format: 'a4',
                    orientation: 'portrait'
                }
            };

    function print(){
        html2pdf().set(opt).from(element).save();
    }
    
    document.getElementById('download').addEventListener('click', print);
</script>
@endpush