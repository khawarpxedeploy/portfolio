"use strict"

/*--------------------------------
        Data get by Ajax Request
    ----------------------------------*/
information();

function information() {
    const tenant_url = document.getElementById("base_url").value;
    $.ajax({
        url: `${tenant_url}/information`
        , type: "get"
        , dataType: "json"
        , success: function(data) {
            // to show data in service section 
            let servicesHtml = '';
            data.service.forEach(service => {
                servicesHtml += `
                <div class="col-lg-4 mb-30">
                    <div class="single-service">
                        <div class="service-icon">
                             <img src="${service.img}" alt="">
                        </div>
                        <div class="service-name">
                              <h5>${service.title}</h5>
                        </div>
                        <div class="service-des">
                            <p>${service.excerpt}</p>
                        </div>
                        
                    </div>
                </div>

            `;
            });
            $(".service_area").html(servicesHtml);

            if (data.service.lenght == 0) {
                 $(".service-area").remove();
            }

            let skills = '';
            data.skills.forEach(skill => {
                skills += `
            <div class="single-skill">
                <h6>${skill.name} ${skill.level}%</h6>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: ${skill.level}%; background-color:${skill.color}" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            `;
            });
            $(".skill_area").html(skills);
            if (data.skills.lenght == 0) {
                $(".skill-area").remove();
            }
            
            // to show data in portfolio section 
            let portfolioHtml = '';
            data.projects.forEach(project => {

                portfolioHtml += `
                    <div class="col-lg-4 mb-30 grid-item cat cat3">
                        <div class="single-portfolio">
                            <a href="${project.link}"><img class="img-fluid" src="${project.img}" alt="${project.title}"></a>
                        </div>
                    </div>
            `;
            });
            $(".portfolio_area").html(portfolioHtml);
            if (data.projects.lenght == 0) {
                $('.portfolio-area').remove();
            }
        
             let experienceHtml = '';
            data.experience.forEach(experience => {
                var exp_date=experience.start_date;
                if (experience.end_date != null) {
                    var exp_date=experience.start_date + '-' + experience.end_date;
                }
                experienceHtml += `
            <div class="col-lg-12 mb-30">
                        <div class="single-education">
                            <div class="row align-items-center">
                                <div class="col-lg-3">
                                    <div class="company-name">
                                        <span>${experience.company}</span>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="education-main-area">
                                        <div class="subject-name">
                                            <h5>${experience.name}</h5>
                                        </div>
                                        <div class="education-des">
                                            <p>${experience.description}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="education-year f-right">
                                        <span>${exp_date}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            `;
            });
            $(".experiance_area").html(experienceHtml);

            if (data.experience.lenght == 0) {
                $(".experiance-area").remove();
            }

            // to show data in blogs section 
            let blogHtml = '';
            data.blogs.forEach(blog => {
              blogHtml += `

                    <div class="col-lg-4">
                        <div class="single-blog">
                            <div class="blog-img">
                                <a href="${blog.url}"><img class="img-fluid" src="${blog.img}" alt=""></a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-content-header">
                                    <span>${blog.date}</span>
                                </div>
                                <div class="blog-title">
                                    <a href="${blog.url}">
                                        <h5>${blog.title}</h5>
                                    </a>
                                </div>
                                <div class="blog-btn">
                                    <a href="${blog.url}">Read More <span class="iconify" data-icon="bytesize:arrow-right" data-inline="false"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
            `;
            });

            $(".blog_area").html(blogHtml);

            if (data.blogs.lenght == 0) {
                $(".blog-area").remove();
            }

        }
    });
}