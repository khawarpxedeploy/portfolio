<link rel="stylesheet" href="{{ asset('cv/theme2/css/form.css?v=1.2.3') }}">
<div class="row layout">
    <div class="col-lg-4 sidebar pt-3">
        <div class="sidebar-section">
            <div class="user-info text-center">
                <div class="user-name">
                    <p class="name"><input type="text" class="text-center" name="name" value="" placeholder="Your Name"></p>
                </div>
                <div class="user-position">
                    <p><input type="text" name="role" class="text-center" value="" placeholder="Your Role"></p>
                </div>
                <div class="user-img">
                    <div class="image-container">
                        <img class="cv-image" alt="" src="{{ asset('uploads/placeholder-profile.png') }}">
                        <input type="file" name="image" id="profile-image">
                    </div>
                </div>
            </div>
            <div class="user-info pt-25">
                <div class="info-header">
                    <div class="resume-card-header d-flex align-items-center justify-content-between">
                        <h4 class="education">{{ __('Education') }}</h4>
                            <div class="resume-add-more-btn">
                                <span class="cv-field-add" data-html="education"><span
                                        class="iconify" data-icon="akar-icons:plus"
                                        data-inline="false"></span> {{ __('Add More') }}</span>
                        </div>
                    </div>
                </div>
                <div class="info-body">
                    <div class="education-main-area">
                        <div class="resume-card-body educationHTML">
                        </div>
                    </div>
                </div>
            </div>
            <div class="user-info pb-100">
                <div class="info-header">
                    <div class="resume-card-header d-flex align-items-center justify-content-between">
                        <h4 class="skills m-0">{{ __('Skills') }}</h4>
                        <div class="resume-add-more-btn">
                            <span class="cv-field-add" data-html="skill"><span class="iconify"
                                    data-icon="akar-icons:plus"
                                    data-inline="false"></span>{{ __('Add More') }}</span>
                        </div>
                    </div>
                </div>
                <div class="info-body">
                    <div class="skill-lists">
                        <div class="resume-card-body skillHTML"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="education-area mt-5">
            <div class="resume-card-header">
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
                        class="cv-field cv-field-textarea single w-100 customfont"
                        placeholder="Your detailed address"></textarea>
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
                <div class="resume-card-body experienceHTML">
                </div>
            </div>
        </div>

        <div class="eduction-area">
            <div class="education-header">
                <div class="resume-card-header d-flex align-items-center justify-content-between">
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

        <div class="education-area">
            <div class="education-header">
                <div class="resume-card-header d-flex align-items-center justify-content-between">
                <h4 class="accomplishments m-0">{{ __('Accomplishments') }}</h4>
                <div class="resume-add-more-btn">
                    <span class="cv-field-add" data-html="accomplishment"><span
                            class="iconify" data-icon="akar-icons:plus"
                            data-inline="false"></span>{{__(' Add More')}}</span>
                </div>
                </div>
            </div>
            <div class="resume-card-body">
                <div class="resume-card-body accomplishmentHTML">
                    <ul class="timeline">

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
