<link rel="stylesheet" href="{{ asset('cv/theme1/css/form.css') }}">
<div>
    <div class="row layout">
        <div class="col-md-4 sidebar">
            <div class="single-sidebar">
                <div class="user-img text-center">
                    <div class="image-container">
                        <input type="hidden" id="placeholderImage" value="{{ asset('uploads/placeholder-profile.png') }}">
                        <img class="cv-image" alt="" src="{{ asset('uploads/placeholder-profile.png') }}">
                        <input type="file" name="image" id="profile-image">
                    </div>
                </div>
                <div class="user-info-area">
                    <div class="info-header">
                        <div class="resume-card-header d-flex align-items-center justify-content-between mb-3">
                            <h4 class="contact m-0">{{ __('Contact') }}</h4>
                            <div class="resume-add-more-btn">
                                <span class="cv-field-add" data-html="contact">
                                    <span class="iconify" data-icon="akar-icons:plus"
                                        data-inline="false"> </span>
                                    {{ __('Add More') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="info-body">
                        <div class="resume-card-section">
                            <div class="resume-card-body contactHTML">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="info-header">
                    <div class="resume-card-header d-flex align-items-center justify-content-between">
                        <h4 class="about_me">{{ __('About Me') }}</h4>
                    </div>
                </div>
                <div class="info-body">
                    <textarea name="about" class="cv-field cv-field-textarea single w-100" placeholder="Write About yourself"></textarea>
                </div>

                <div class="info-header">
                    <div class="resume-card-header d-flex align-items-center justify-content-between">
                        <h4 class="address">{{ __('Address') }}</h4>
                    </div>
                </div>
                <div class="info-body">
                    <div class="resume-card-section">
                        <textarea name="address"
                        class="cv-field cv-field-textarea single w-100"
                        placeholder="Your detailed address"></textarea>
                    </div>
                </div>

                <div class="user-info-area">
                    <div class="info-header">
                        <div class="resume-card-header d-flex align-items-center justify-content-between mb-3">
                            <h4 class="references m-0">{{ __('References') }}</h4>
                            <div class="resume-add-more-btn">
                                <span class="cv-field-add" data-html="reference"><span
                                        class="iconify" data-icon="akar-icons:plus"
                                        data-inline="false"></span> {{ __('Add More') }}</span>
                            </div>
                        </div>
                        
                    </div>
                    <div class="info-body">
                        <div class="resume-card-body referenceHTML">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="template-right-section">
                <div class="user-area">
                    <div class="user-name">
                        <p class="name"><input type="text" name="name" value="" placeholder="Your Name"></p>
                        <p><input type="text" name="role" value="" placeholder="Your Role"></p>
                    </div>
                </div>
                <div class="eduction-area">
                    <div class="education-header">
                    <div class="resume-card-header d-flex align-items-center justify-content-between mb-3">
                        <h4 class="education m-0">{{ __('Education') }}</h4>
                            <div class="resume-add-more-btn">
                                <span class="cv-field-add" data-html="education"><span
                                        class="iconify" data-icon="akar-icons:plus"
                                        data-inline="false"></span> {{ __('Add More') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="education-body">
                        <div class="single-education">
                            <div class="resume-card-body educationHTML">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="eduction-area">
                    <div class="education-header">
                        <div class="resume-card-header d-flex align-items-center justify-content-between mb-2">
                            <h4 class="experience m-0">{{ __('Experience') }}</h4>
                            <div class="resume-add-more-btn">
                                <span class="cv-field-add" data-html="experience"><span
                                        class="iconify" data-icon="akar-icons:plus"
                                        data-inline="false"></span> {{ __('Add More') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="education-body">
                        <div class="single-education">
                            <div class="resume-card-body experienceHTML">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="eduction-area">
                    <div class="education-header">
                        <div class="resume-card-header d-flex align-items-center justify-content-between mb-3">
                            <h4 class="skills m-0">{{ __('Skills') }}</h4>
                            <div class="resume-add-more-btn">
                                <span class="cv-field-add" data-html="skill"><span class="iconify"
                                        data-icon="akar-icons:plus"
                                        data-inline="false"></span>{{ __('Add More') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="education-body">
                        <div class="resume-card-body skillHTML"></div>
                    </div>
                </div>


                <div class="eduction-area">
                    <div class="education-header">
                        <div class="resume-card-header d-flex align-items-center justify-content-between mb-3">
                        <h4 class="accomplishments m-0">{{ __('Accomplishments') }}</h4>
                        <div class="resume-add-more-btn">
                            <span class="cv-field-add" data-html="accomplishment"><span
                                    class="iconify" data-icon="akar-icons:plus"
                                    data-inline="false"></span>{{__(' Add More')}}</span>
                        </div>
                        </div>
                    </div>
                    <div class="education-body">
                        <div class="resume-card-body accomplishmentHTML">
                            <ul class="timeline">
        
                            </ul>
                        </div>
                    </div>
                </div>

              
            </div>
        </div>
    </div>
</div>
