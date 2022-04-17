"use strict"

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

        // to show data in portfolio section 
        let portfolioHtml = '';
        data.projects.forEach(project => {

            portfolioHtml += `
                <div class="col-lg-4 mb-30 grid-item cat4">
                    <div class="single-portfolio">
                        <div class="portfolio-img">
                            <img class="img-fluid" src="${project.img}" alt="">
                        </div>
                        <div class="portfolio-name">
                            <h5>${project.title}</h5>
                            <a href="${project.link}"><span class="iconify" data-icon="akar-icons:circle-plus" data-inline="false"></span></a>
                        </div>
                    </div>
                </div>
        `;
        });
        $(".portfolio_section").html(portfolioHtml);

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
                                <a href="${blog.url}">Read More <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32" class="iconify" data-icon="bytesize:arrow-right" data-inline="false" style="transform: rotate(360deg);"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M22 6l8 10l-8 10m8-10H2"></path></g></svg></a>
                            </div>
                        </div>
                    </div>
                </div>

        `;
        });
        $(".blog_area").html(blogHtml);

        }
    });
}