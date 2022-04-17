@extends('layouts.backend.app')

@section('title','VCard')

@section('head')
@include('layouts.backend.partials.headersection')
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12 col-md-6 col-xl-6">
        <div class="card">
            <div class="card-header mx-3 mt-3 position-relative z-index-1">
                <div class="row w-100 align-items-center">
                    <div class="col-lg-6">
                        <h4 class="header-vcard-title"><i class="fas fa-layer-group"></i>{{ __('  Your Card') }}</h4>
                    </div>
                    <div class="col-lg-6 pr-0">
                        <div class="float-right vacard-view">
                            @php
                                $tenant = App\Models\Tenant::where('user_id',Auth::User()->id)->first();
                            @endphp
                            <a target="blank" href="{{ url(env('APP_URL_WITH_TENANT').$tenant->id.'/vcard') }}" class="btn btn-primary btn-sm"><i class="fas fa-eye float-end"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('user.vcard.store') }}" method="POST" enctype="multipart/form-data"
                class="basicform">
                @csrf
                @if(!empty($user))
                @php $value = json_decode($user->value ?? ''); @endphp
                @endif
                <div class="card-body pt-2 overflow-auto" height="700" id="vcard-box">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>{{ __('Whoops!') }}</strong>
                        {{ __('There were some problems with your input.') }}<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="row">
                        @foreach ($theme ?? [] as $key=> $theme)
                        <div class="col-lg-6">
                            <div class="single-vcard-section">
                                <label class="form-check-label single-vcard-img @if(isset($value)){{ $value->theme == $theme->asset_path ?  'active' : '' }}  @endif" for="{{ $theme->name }}">
                                    <span class="d-block">
                                        <img src="{{ asset($theme->asset_path) }}/screenshot.png"
                                            class="img-fluid border-radius-lg">
                                    </span>
                                    <h5 class="theme-title text-center">
                                        {{ $theme->name }}
                                    </h5>
                                </label>

                                @if(isset($value))
                                <input class="form-check-input d-none" type="radio" name="theme"
                                    {{ ($value->theme && $theme->asset_path == $value->theme) || $key == 0 ? 'checked' : '' }}
                                    id="{{ $theme->name }}" value="{{ $theme->view_path }}">
                                @else
                                <input class="form-check-input d-none" type="radio" name="theme" id="{{ $theme->name }}"
                                    value="{{ $theme->view_path }}">
                                @endif
                            </div>
                        </div>
                        @endforeach
                        <div class="col-lg-12 mt-4">
                            <div class="row align-items-center">
                                <div class="col-lg-6"><label>{{ __('Card Color') }}</label></div>
                                <div class="col-lg-6">
                                    <div class="float-right">
                                        <input type="color" class="float-end " name="color" value="{{ $value->color ?? null }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-4">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <label>{{ __('Profile Image') }}</label>
                                </div>
                                <div class="col-6"> <input type="file" class="form-control" name="profile_image"></div>
                            </div>
                        </div>
                        @if($user == !null)
                        <div class="col-lg-12 mt-4">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <label>{{ __('Preview Profile Image') }}</label>
                                </div>
                                <div class="col-lg-6"> 
                                    <div class="float-right">
                                        <img src="{{ asset($value->profile_image_url ?? null) }}" alt="" class="w-25"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-lg-12 mt-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>{{ __('Cover Image') }}</label>
                                </div>
                                <div class="col-lg-6"> <input type="file" class="form-control" name="cover_image"></div>
                            </div>
                        </div>
                        @if($user == !null)
                        <div class="col-lg-12 mt-4">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <label>{{ __('Preview Cover Image') }}</label>
                                </div>
                                <div class="col-6"> <img class="w-25" src="{{ asset($value->cover_image_url ?? null) }}"
                                        alt=""> </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-lg-12 mt-4">
                            <div class="row align-items-center">
                                <div class="col-lg-12">
                                    @if($user == ! null)
                                    <label for="">{{ __('Slug') }}</label>
                                    <input type="text" class="form-control" name="slug" placeholder="Enter Your Slug"
                                        value="{{ old('slug')?? $value->slug }}">
                                    @else
                                    <input type="text" class="form-control" name="slug" placeholder="Enter Your Slug">
                                    @endif
                                    <p><small>{{ __('Use only alphanumeric value without space. (Hyphen(-) allow). Slug will be used for card url.') }}</small>
                                    </p>
                                </div>
                                <div class="col-lg-12">
                                    @if($user == ! null)
                                    <label for="">{{ __('Name') }}</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Your Name"
                                        value="{{ old('name')?? $value->name ?? '' }}">
                                    @else
                                    <input type="text" class="form-control" name="name" placeholder="Enter Your Name">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-4">
                            @if($user == !null)
                            <label for="">{{ __('Tagline') }}</label>
                            <input type="text" class="form-control" name="tagline"
                                placeholder="Enter Your Sub Title"
                                value="{{ old('tagline')??$value->tagline ?? '' }}">
                            @else
                            <input type="text" class="form-control" name="tagline"
                                placeholder="Enter Your Sub Title">
                            @endif
                        </div>
                        <div class="col-lg-12 mt-4">
                            @if($user == ! null)
                            <label for="">{{ __('Description') }}</label>
                            <textarea name="description" id="" cols="30" rows="10" class="form-control"
                                name="tagline"
                                placeholder="Enter Your Description">{{ $value->description }}</textarea>
                            @else
                            <textarea name="description" id="" cols="30" rows="10" class="form-control"
                                name="tagline" placeholder="Enter Your Description"></textarea>
                            @endif
                        </div>

                        @foreach ($value->social ?? [] as $key => $item)
                        <div class="col-lg-12">
                            <div class="row mt-4">
                                <input type="hidden" name="social[{{$key}}][field_name]" value="{{ $item->field_name }}">
                                <div class="col-6 mt-2">
                                    <label for="" id="labelValue">{{ $item->field_name }}</label>
                                </div>
                                <div class="col-6 float-end mb-3">
                                    <a href="javascript:void(0)" onclick="$(this).parent().parent().remove();"
                                        class="remove_main_button btn btn-danger float-right"><i
                                            class="far fa-times-circle float-end"></i></a>
                                </div>
                                <div class="col-12">
                                    <input type="text" id="inputValue1" class="form-control"
                                        name="social[{{ $key }}][value]" placeholder="{{"Value"}}"
                                        value="{{ $item->value }}">
                                </div>
                                <div class="col-12 mt-2">
                                    <input type="text" class="form-control" id="inputValue2"
                                        name="social[{{ $key }}][label]" placeholder="Label" value="{{ $item->label }}">

                                    <input type="hidden" name="social[{{ $key }}][type]" value="{{ $item->type ?? '' }}">
                                </div>
                            </div>
                            
                        </div>
                        @endforeach
                        <div class="field_wrapper" id="field_wrapper2">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-lg w-100 basicbtn">{{ __('Submit') }}</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-xl-6">
        <div class="card">
            <div class="card-header mx-3 mt-3 position-relative z-index-1">
                <h4>{{ __('Add New Information') }}</h4>
            </div>
            <div class="card-body pt-2">
                <div class="container">
                    <div class="row icon-examples mb-4">
                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Phone"
                                data-field-type="text" data-placeholder="Phone Number">
                                <div>
                                    <div class="col-12"><i class="fas fa-phone"></i></div>
                                    <div class="col-12"><span>{{ _('Phone') }}</span></div>
                                </div>
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Email"
                                data-field-type="email" data-placeholder="Email Address">
                                <div>
                                    <div class="col-12"><i class="fas fa-envelope"></i></div>
                                    <div class="col-12"><span>{{ __('Email') }}</span></div>
                                </div>
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Address"
                                data-field-type="text" data-placeholder="Enter Your address">
                                <div>
                                    <div class="col-12"><i class="fas fa-map-marker-alt"></i></div>
                                    <div class="col-12"><span>{{ __('Address') }}</span></div>
                                </div>
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Website"
                                data-field-type="text" data-placeholder="https://example.com">
                                <div>
                                    <div class="col-12"><i class="fas fa-link"></i></div>
                                    <div class="col-12"><span>{{ __('Website') }}</span></div>
                                </div>
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Text"
                                data-field-type="text" data-placeholder="Enter your text">
                                <div>
                                    <div class="col-12"><i class="fas fa-align-left"></i></div>
                                    <div class="col-12"><span>{{ __('Text') }}</span></div>
                                </div>
                            </button>
                        </div>

                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Facebook"
                                data-field-type="text" data-placeholder="Facebook Profile Link">
                                <div>
                                    <div class="col-12"><i class="fab fa-facebook-square"></i></div>
                                    <div class="col-12"><span>{{ __('Facebook') }}</span></div>
                                </div>
                            </button>
                        </div>

                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Twitter"
                                data-field-type="text" data-placeholder="Twitter Profile Link">
                                <div>
                                    <div class="col-12"><i class="fab fa-twitter"></i></div>
                                    <div class="col-12"><span>{{ __('Twitter') }}</span></div>
                                </div>
                            </button>
                        </div>

                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Instragram"
                                data-field-type="text" data-placeholder="Instagram Profile Link">
                                <div>
                                    <div class="col-12"><i class="fab fa-instagram"></i></div>
                                    <div class="col-12"><span>{{ __('Instragram') }}</span></div>
                                </div>
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Whatsapp"
                                data-field-type="text" data-placeholder="Whatsapp Number">
                                <div>
                                    <div class="col-12"><i class="fab fa-whatsapp"></i></div>
                                    <div class="col-12"><span>{{ __('Whatsapp') }}</span></div>
                                </div>
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Telegram"
                                data-field-type="text" data-placeholder="Telegram Profile Link">
                                <div>
                                    <div class="col-12"><i class="fab fa-telegram-plane"></i></div>
                                    <div class="col-12"><span>{{ __('Telegram') }}</span></div>
                                </div>
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Skype"
                                data-field-type="text" data-placeholder="Skype Invite Link">
                                <div>
                                    <div class="col-12"><i class="fab fa-skype"></i></div>
                                    <div class="col-12"><span>{{ __('Skype') }}</span></div>
                                </div>
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="WeChat"
                                data-field-type="text" data-placeholder="WeChat Profile Link">
                                <div>
                                    <div class="col-12"><i class="fab fa-weixin"></i></div>
                                    <div class="col-12"><span>{{ __('WeChat') }}</span></div>
                                </div>
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Snapchat"
                                data-field-type="text" data-placeholder="Snapchat Profile Link">
                                <div>
                                    <div class="col-12"><i class="fab fa-snapchat-ghost"></i></div>
                                    <div class="col-12"><span>{{ __('Snapchat') }}</span></div>
                                </div>
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Linkedin"
                                data-field-type="text" data-placeholder="Linkedin Profile Link">
                                <div>
                                    <div class="col-12"><i class="fab fa-linkedin-in"></i></div>
                                    <div class="col-12"><span>{{ __('Linkedin') }}</span></div>
                                </div>
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Pinterest"
                                data-field-type="text" data-placeholder="Pinterest Profile Link">
                                <div>
                                    <div class="col-12"><i class="fab fa-pinterest"></i></div>
                                    <div class="col-12"><span>{{ __('Pinterest') }}</span></div>
                                </div>
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Vimeo"
                                data-field-type="text" data-placeholder="Vimeo Profile Link">
                                <div>
                                    <div class="col-12"><i class="fab fa-vimeo-v"></i></div>
                                    <div class="col-12"><span>{{ __('Vimeo') }}</span></div>
                                </div>
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Dribbble"
                                data-field-type="text" data-placeholder="Dribbble Profile Link">
                                <div>
                                    <div class="col-12"><i class="fab fa-dribbble"></i></div>
                                    <div class="col-12"><span>{{ __('Dribbble') }}</span></div>
                                </div>
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Behance"
                                data-field-type="text" data-placeholder="Behance profile Link">
                                <div>
                                    <div class="col-12"><i class="fab fa-behance"></i></div>
                                    <div class="col-12"><span>{{ __('Behance') }}</span></div>
                                </div>
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Youtube"
                                data-field-type="text" data-placeholder="Youtube Profile Link">
                                <div>
                                    <div class="col-12"><i class="fab fa-youtube"></i></div>
                                    <div class="col-12"><span>{{ __('Youtube') }}</span></div>
                                </div>
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Flickr"
                                data-field-type="text" data-placeholder="Flickr Profile Link">
                                <div>
                                    <div class="col-12"><i class="fab fa-flickr"></i></div>
                                    <div class="col-12"><span>{{ __('Flickr') }}</span></div>
                                </div>
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Tiktok"
                                data-field-type="text" data-placeholder="Tiktok Profile Link">
                                <div>
                                    <div class="col-12"><i class="fab fa-tiktok"></i></div>
                                    <div class="col-12"><span>{{ __('Tiktok') }}</span></div>
                                </div>
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Discord"
                                data-field-type="text" data-placeholder="Discord Profile Link">
                                <div>
                                    <div class="col-12"><i class="fab fa-discord"></i></div>
                                    <div class="col-12"><span>{{ __('Discord') }}</span></div>
                                </div>
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Twitch"
                                data-field-type="text" data-placeholder="Twitch Profile Link">
                                <div>
                                    <div class="col-12"><i class="fab fa-twitch"></i></div>
                                    <div class="col-12"><span>{{ __('Twitch') }}</span></div>
                                </div>
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Github"
                                data-field-type="text" data-placeholder="Github Profile Link">
                                <div>
                                    <div class="col-12"><i class="fab fa-github"></i></div>
                                    <div class="col-12"><span>{{ __('Github') }}</span></div>
                                </div>
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="button"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Paypal"
                                data-field-type="text" data-placeholder="Paypal Profile Link">
                                <div>
                                    <div class="col-12"><i class="fab fa-paypal"></i></div>
                                    <div class="col-12"><span>{{ __('Paypal') }}</span></div>
                                </div>
                            </button>
                        </div>
                        <div class="col-4">
                            <button type="submit"
                                class="bg-gray-100 py-3 single-vcard d-inline-block border border-light border-radius-md w-100 mb-4 info_icon"
                                data-clipboard-text="active-40" title="Copy to clipboard" data-name="Soundcloud"
                                data-field-type="text" data-placeholder="Soundcloud Profile Link">
                                <div>
                                    <div class="col-12"><i class="fab fa-soundcloud"></i></div>
                                    <div class="col-12"><span>{{ __('Soundcloud') }}</span></div>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('backend/admin/assets/js/userend-vcard.js') }}"></script>
@endpush