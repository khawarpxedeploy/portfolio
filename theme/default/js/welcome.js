"use strict";

/*----------------------------
        Information Data Get
    ------------------------------*/
information();




function information() {
    const lastItem = $('#base_url').val();
    $.ajax({
        url: `${lastItem}/information`,
        type: "get",
        dataType: "json",
        success: function(data) {
            /*--------------------------------
                    view skill section data
                --------------------------------*/

            let serviceHtml = "";
            if (data.service.length > 0) {
                data.service.forEach((service) => {
                    serviceHtml += `<div class="col-lg-4">
                                    <div class="single-service text-center">
                                        <div class="service-img">
                                            <img src="${service.img}">
                                            
                                        </div>
                                        <div class="service-title">
                                            <h2>${service.title}</h2>
                                        </div>
                                        <div class="service-des">
                                            <p>${service.excerpt}</p>
                                        </div>
                                    </div>
                                </div>`;
                });
            }
            $(".services").html(serviceHtml);


            /*--------------------------------
                    experience section data
                --------------------------------*/
            let experienceHtml = "";
            data.experience.forEach((experience) => {
                experienceHtml += `<div class="education-title">
                                        <h2><span class="iconify" data-icon="clarity:briefcase-line" data-inline="false"></span> ${experience.name}</h2>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="education-year">
                                            <p>${experience.start_date} - ${experience.end_date}</p>
                                        </div>
                                    </div>
                                    <div class="education-details">
                                        <p>${experience.description ?? ''}</p>
                                    </div>`;
            });
            $(".experience").html(experienceHtml);

            /*--------------------------------
                    educaiton section data
                --------------------------------*/
            let htmlData = "";
            data.education.forEach((education) => {
                var endDate = new Date().toDateString(education.ending_date);
                htmlData += `<div class="education-title">
                                <h2><span class="iconify" data-icon="cil:education" data-inline="false"></span> ${education.subject}</h2>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="education-year">
                                    <p>${education.ending_date}</p>
                                </div>
                                <div class="your-position">
                                    <p>${education.university}</p>
                                </div>
                            </div>
                            <div class="education-details">
                                <p>${education.short_content}</p>
                            </div>
                            `;
            });
            $(".education").html(htmlData);

            /*---------------------------------------
                    show data in portfolio section
                ---------------------------------------*/
            let portfolioHtml = "";
            data.projects.forEach((project) => {
                portfolioHtml += `<div class="col-lg-6">
                <a href="${project.link}" target="_blank">
                    <div class="single-portfolio">
                        <div class="portfolio-img">
                            <img class="img-full" src="${project.img}" alt="">
                        </div>
                    </div>
                    <div class="portfolio-name">
                        <h2>${project.title}</h2>
                    </div>
                </a>
            </div>`;
            });
            $(".projects").html(portfolioHtml);

            /*---------------------------------------
                    testimonials section data
                ---------------------------------------*/
            let testimonialsHtml = "";
            data.testimonials.forEach((testimonial) => {
                testimonialsHtml += `<div class="col-lg-6">
                        <div class="single-review">
                            <div class="review-des">
                                <p>"${testimonial.review}"</p>
                            </div>
                            <div class="review-bottom-area">
                                <div class="user-img">
                                    <a href="#">
                                        <img src="${testimonial.img}" alt="">
                                    </a>
                                </div>
                                <div class="client-name-position">
                                    <h5>${testimonial.name}</h5>
                                    <p>${testimonial.position}</p>
                                </div>
                            </div>
                        </div>
                    </div>`;
            });
            $(".reviews").html(testimonialsHtml);

            /*----------------------------
                    show blog data
                ------------------------------*/
            let blogHtml = "";
            data.blogs.forEach((blog) => {
                blogHtml += ` <div class="col-lg-4">
                            <div class="single-blog">
                                <div class="blog-img">
                                    <a href="${blog.url}"><img class="img-fluid" src="${blog.img}" alt=""></a>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-title">
                                        <a href="${blog.url}"><h2>${blog.title}</h2></a>
                                    </div>
                                    <div class="blog-date-author">
                                    <div class="blog-date">
                                        <span class="iconify" data-icon="uil:calender" data-inline="false"></span> ${blog.date}
                                    </div>
                                       
                                    </div>
                                    <div class="blog-des">
                                        <p>${blog.des}</p>
                                    </div>
                                    <div class="blog-action">
                                        <a href="${blog.url}">Read More <span class="iconify" data-icon="bi:arrow-right" data-inline="false"></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>`;
            });
            $(".blogs").html(blogHtml);
        },
    });
}