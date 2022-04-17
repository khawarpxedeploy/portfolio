"use strict";

/*----------------------------
       	Information Data Get
    ------------------------------*/
information();



function information() {

    const tenant_url = $('#base_url').val();
      $.ajax({
            url: `${tenant_url}/information`,
            type: "get",
            dataType: "json",
            success: function(data) {
            // to show data in service section 
            let servicesHtml = '';
            data.service.forEach(service => {
                servicesHtml += `<div class="col-lg-4 mb-30">
                <div class="single-service">
                    <div class="service-img">
                        <img src="${service.img}" alt="">
                    </div>
                    <div class="service-title">
                        <h4>${service.title}</h4>
                    </div>
                    <div class="service-des">
                        <p>${service.excerpt}</p>
                    </div>
                </div>
            </div>`;
            });
            $(".services").html(servicesHtml);

            // to show data in portfolio section 
            let portfolioHtml = '';
            data.projects.forEach(project => {

                portfolioHtml += `<div class="col-lg-6 mb-30">
                <a href="${project.link}">
                    <div class="single-portfolio">
                        <div class="portfolio-img">
                            <img class="img-fluid"
                                src="${project.img}"
                                alt="">
                        </div>
                        <div class="potfolio-title">
                            <h4>${project.title}</h4>
                        </div>
                    </div>
                </a>
            </div>`;
            });
            $("#portfolio-section").html(portfolioHtml);

            // to show data in blogs section 
            let blogHtml = '';
            data.blogs.forEach(blog => {

              blogHtml += `<div class="col-lg-6">
                <div class="single-news">
                    <div class="news-img">
                        <a href="#">
                            <img class="img-fluid"
                                src="${blog.img}" alt="">
                        </a>
                    </div>
                    <div class="news-content">
                        <div class="news-title">
                            <a href="#">
                                <h4>${blog.title}</h4>
                            </a>
                        </div>
                        <div class="news-date-author">
                            <div class="news-date">
                                <span class="iconify" data-icon="uil:calender"
                                    data-inline="false"></span>${blog.date}
                            </div>
                            
                        </div>
                        <div class="news-des">
                            <p>${blog.des}</p>
                        </div>
                        <div class="news-btn">
                            <a href="${blog.url}">Read More <span class="iconify"
                                    data-icon="bx:bx-right-arrow-circle"
                                    data-inline="false"></span></a>
                        </div>
                    </div>
                </div>
            </div>`;
            });
            $(".blogs").html(blogHtml);
        }
    });
}