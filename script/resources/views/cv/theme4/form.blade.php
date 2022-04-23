<link rel="stylesheet" href="{{ asset('cv/theme4/css/form.css') }}">
<div>
    <div class="row layout">
        <div class="col-lg-6 offset-lg-3">
            <div class="user-area text-center">
                <div class="user-name">
                    <div class="name-border">
                        <p class="name"><input class="text-center" type="text" name="name" value="" placeholder="Your Name"></p>
                    </div>
                    <p><input type="text" name="role" value="" placeholder="Your Role"></p>
                </div>
            </div>
            <div class="user-img text-center pt-0"> 
                <div class="image-container">
                     <!-- cv-image class require to render your image  -->
                    <img class="cv-image" src="" alt="">
                    <!-- input with profile-image id is required to upload an image  -->
                    <input type="file" name="image" id="profile-image">
                </div>
    
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 border-right">
                <div class="cv-left-area text-right">
                    <div class="eduction-area">
                        <div class="education-header">
                            <div class="resume-card-header d-flex align-items-center justify-content-between mb-2">
                                <h4 class="experience m-0">{{ __('Experience') }}</h4>
                                <!-- resume-add-more-btn class for button design purpose  -->
                                <div class="resume-add-more-btn">
                                    <!-- cv-field-add class to appened multiple values -->
                                    <!-- data-html="experience" attribute is required  -->
                                    <span class="cv-field-add" data-html="experience"><span
                                            class="iconify" data-icon="akar-icons:plus"
                                            data-inline="false"></span> {{ __('Add More') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="education-body">
                            <div class="single-education">
                                <!-- experienceHTML class to render the append experience data -->
                                <div class="resume-card-body experienceHTML">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="education-header">
                    <div class="resume-card-header d-flex align-items-center justify-content-between mb-3">
                        <h4 class="education m-0">{{ __('Education') }}</h4>
                        <!-- resume-add-more-btn class for button design purpose  -->
                        <div class="resume-add-more-btn">
                            <!-- cv-field-add class to appened multiple values  -->
                            <!-- data-html="education" attribute is required  -->
                            <span class="cv-field-add" data-html="education"><span
                                    class="iconify" data-icon="akar-icons:plus"
                                    data-inline="false"></span> {{ __('Add More') }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="education-body">
                    <div class="single-education">
                        <!-- educationHTML class to render the append education data -->
                        <div class="resume-card-body educationHTML">
                        </div>
                    </div>
                </div>
                
                <div class="eduction-area">
                    <div class="education-header">
                        <div class="resume-card-header d-flex align-items-center justify-content-between mb-3">
                            <h4 class="skills m-0">{{ __('Skills') }}</h4>
                            <!-- resume-add-more-btn class for button design purpose  -->
                            <div class="resume-add-more-btn">
                                <!-- cv-field-add class to appened multiple values -->
                                <!-- data-html="skill" attribute is required  -->
                                <span class="cv-field-add" data-html="skill"><span class="iconify"
                                        data-icon="akar-icons:plus"
                                        data-inline="false"></span>{{ __('Add More') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="education-body">
                        <!-- experienceHTML class to render the append experience data -->
                        <div class="resume-card-body skillHTML"></div>
                    </div>
                </div>
                <div class="user-info-area pl-0">
                    <div class="info-header">
                        <div class="resume-card-header d-flex align-items-center justify-content-between mb-3">
                            <h4 class="contact m-0">{{ __('Contact') }}</h4>
                            <!-- resume-add-more-btn class for button design purpose  -->
                            <div class="resume-add-more-btn">
                                <!-- cv-field-add class to appened multiple values  -->
                                <!-- data-html="contact" attribute is required  -->
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
                            <!-- contactHTML class to render the append contacts  -->
                            <div class="resume-card-body contactHTML">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="user-info-area pl-0">
                    <div class="info-header">
                        <div class="resume-card-header d-flex align-items-center justify-content-between mb-3">
                            <h4 class="references m-0">{{ __('References') }}</h4>
                            <!-- resume-add-more-btn class for button design purpose  -->
                            <div class="resume-add-more-btn">
                                 <!-- cv-field-add class to appened multiple values  -->
                                 <!-- data-html="reference" attribute is required  -->
                                <span class="cv-field-add" data-html="reference"><span
                                        class="iconify" data-icon="akar-icons:plus"
                                        data-inline="false"></span> {{ __('Add More') }}</span>
                            </div>
                        </div>
                        
                    </div>
                    <div class="info-body">
                        <!-- referenceHTML class to render the append references  -->
                        <div class="resume-card-body referenceHTML">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
