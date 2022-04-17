<link rel="stylesheet" href="{{ asset('cv/theme5/css/form.css') }}">
<div>
    <div class="row layout">
        <div class="col-lg-12 p-0">
            <div class="cv-header-area sidebar">
                <div class="user-area text-center">
                    <div class="user-name user-border-theme5">
                        <p class="name"><input class="text-center name" type="text" name="name" value="" placeholder="Your Name"></p>
                        <p class="mb-0"><input type="text" class="text-center position" name="role" value="" placeholder="Your Role"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="cv-body-area">
            <div class="row">
                <div class="col-lg-8 border-right">
                    <div class="about-section">
                        <div class="info-header">
                            <div class="resume-card-header d-flex align-items-center justify-content-between">
                                <h4 class="about_me">{{ __('About Me') }}</h4>
                            </div>
                        </div>
                        <div class="info-body">
                            <textarea name="about" class="cv-field cv-field-textarea single w-100"
                                placeholder="Write About yourself"></textarea>
                        </div>
                    </div>
                    <div class="eduction-area mt-5">
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
                </div>
                <div class="col-lg-4">
                    <div class="user-info-area pl-0">
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
                    <div class="eduction-area mt-5">
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
                    <div class="eduction-area mt-5">
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
                </div>
            </div>
        </div>
    </div>
</div>
