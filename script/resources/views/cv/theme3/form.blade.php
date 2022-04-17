<link rel="stylesheet" href="{{ asset('cv/theme3/css/form.css') }}">
<div class="row layout p-30">
    <div class="col-lg-7 pt-4 pr-2">
        <div class="sidebar-section">
            <div class="user-info">
                <div class="user-position">
                    <h2><input type="text" class="w-100" name="role" value="" placeholder="Your Role"></h2>
                </div>
                <div class="user-name">
                    <h3 class="name"><input type="text" class="w-100" name="name" value="" placeholder="Your Name"></h3>
                </div>
            </div>
            <div class="education-area mt-5">
                <div class="education-header">
                    <h4 class="about_me">{{ __('About Me') }}</h4>
                </div>
                <div class="education-body">
                    <textarea name="about"
                            class="cv-field cv-field-textarea single w-100 customfont"
                            placeholder="Write About yourself"></textarea>
                        
                    <div class="info-body mt-3">
                        <h4 class="address">{{ __('Address') }}</h4>
                        <div class="">
                            <textarea name="address"
                            class="cv-field cv-field-textarea single w-100"
                            placeholder="Your detailed address"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="education-area mt-5">
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
                    <div class="resume-card-body experienceHTML">
                    </div>
                </div>
            </div>



            <div class="education-area mt-5">
                <div class="education-header">
                    <div class="resume-card-header d-flex align-items-center justify-content-between mb-3">
                        <h4 class="references m-0">{{ __('References') }}</h4>
                        <div class="resume-add-more-btn">
                            <span class="cv-field-add" data-html="reference"><span
                                    class="iconify" data-icon="akar-icons:plus"
                                    data-inline="false"></span> {{ __('Add More') }}</span>
                        </div>
                    </div>
                </div>
                <div class="education-body">
                    <div class="resume-card-body referenceHTML">
                    </div>
                </div>
            </div>

            <div class="education-area mt-5">
                <div class="education-header">
                    <h4 class="language">{{ __('Language') }}</h4>
                </div>
                <div class="education-body">
                    <textarea name="language"
                            class="cv-field cv-field-textarea single w-100 customfont"
                            placeholder="English, Bengali ...."></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="education-area">
            <div class="education-header text-center">
                <div class="resume-card-header d-flex align-items-center justify-content-between mb-3">
                    <h4 class="contact m-0">{{ __('Contact') }}</h4>
                        <div class="resume-add-more-btn">
                            <span class="cv-field-add" data-html="contact"><span
                                    class="iconify" data-icon="akar-icons:plus"
                                    data-inline="false"></span> {{ __('Add More') }}</span>
                        </div>
                    </div>
            </div>
            <div class="education-body">
                <div class="education-main-area">
                    <div class="resume-card-body contactHTML">
                    </div>
                </div>
            </div>
        </div>

        <div class="education-area mt-5">
            <div class="education-header text-center">
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
                <div class="education-main-area">
                    <div class="resume-card-body educationHTML">
                    </div>
                </div>
            </div>
        </div>

        <div class="education-area mt-5">
            <div class="education-header">
                <div class="resume-card-header d-flex align-items-center justify-content-between mb-2">
                    <h4 class="skills m-0">{{ __('Skills') }}</h4>
                    <div class="resume-add-more-btn">
                        <span class="cv-field-add" data-html="skill"><span class="iconify"
                                data-icon="akar-icons:plus"
                                data-inline="false"></span>{{ __('Add More') }}</span>
                    </div>
                </div>
            </div>
            <div class="education-body">
                <div class="skill-lists">
                    <div class="resume-card-body skillHTML"></div>
                </div>
            </div>
        </div>

        <div class="education-area mt-5">
            <div class="education-header">
                <div class="resume-card-header d-flex align-items-center justify-content-between mb-3">
                <h4 class="accomplishments m-0">{{ __('Accomplishments') }}</h4>
                <div class="resume-add-more-btn">
                    <span class="cv-field-add" data-html="accomplishment"><span
                            class="iconify" data-icon="akar-icons:plus"
                            data-inline="false"></span>{{__(' Add')}}</span>
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
