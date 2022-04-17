"use strict";

/*----------------------------
       	Language Switch 
    ------------------------------*/
$('#language_switch').on('change',function() {
    var value = $('#language_switch').val();
    var url = $('#language_url').val();
    $.ajax({
        type: 'GET',
        url: url,
        data: {lang: value},
        dataType: 'json',
        success: function(response) {
            if(response == 'success'){
                location.reload();
            }
        },
        error: function(xhr, status, error) {
            $('.basicbtn').removeAttr('disabled');
            $('.basicbtn').html(btnhtml);

            $.each(xhr.responseJSON.errors, function(key, item) {
                Sweet('error', item)
                $("#errors").html("<li class='text-danger'>" + item + "</li>")
            });
            errosresponse(xhr, status, error);
        }
    })
})

/*----------------------------
       	Information Get  
    ------------------------------*/
information();
function information() {
    $.ajax({
        url: `/information`,
        type: "get",
        dataType: "json",
        success: function(data) {
            //Asked Quedtions section data view
            let askedHtml = '';
            data.basic.asked.forEach(function(v, i) {
                askedHtml += `<div class="col-lg-6">
                              <div class="single-faq mb-30">
                                  <div class="faq-content">
                                      <h4>${i+1}.  ${v.question}</h4>
                                      <p>${v.answer}</p>
                                  </div>
                              </div>
                          </div>`;
            });
            $(".asked-html").html(askedHtml);

            // benefit section 
            let benefitHtml = '';
            data.benefit.forEach(benefit => {
                benefitHtml += `<div class="col-lg-4 mb-30">
                                  <div class="single-benefit text-center">
                                      <div class="benefit-img">
                                          <img src="${benefit.img}"  alt="benefit img" style="height: 148px; width: 148px;">
                                      </div>
                                      <div class="benefit-title">
                                          <h2>${benefit.title}</h2>
                                      </div>
                                      <div class="benefit-des">
                                          <p>${benefit.excerpt}</p>
                                      </div>
                                  </div>
                              </div>`;
            });
            $(".benefit").html(benefitHtml);

            //pricing-table section 
            let planHtml = '';
            data.plans.forEach(plan => {
                planHtml += `<div class="col-lg-3">
                              <div class="single-pricing">
                                  <div class="pricing-type">
                                      <h6>${plan.name}</h6>
                                  </div>
                                  <div class="pricing-price">
                                      <sub> ${plan.symbol} </sub> ${plan.price} <sub>/ ${plan.duration}</sub>
                                  </div>
                                  <div class="pricing-list">
                                      <ul>
                                          <li class="${plan.resume_builder == '0' ? 'active' : ''}"><span class="iconify" ${plan.resume_builder == '1' ? 'data-icon="akar-icons:check"' : 'data-icon="akar-icons:cross"'} data-inline="false"></span>Resume Builder</li>

                                          <li class="${plan.portfolio_builder == '0' ? 'active' : ''}"><span class="iconify" ${plan.portfolio_builder == '1' ? 'data-icon="akar-icons:check"' : 'data-icon="akar-icons:cross"'} data-inline="false"></span>Portfolio Builder</li>

                                          <li class="${plan.custom_domain == '0' ? 'active' : ''}"><span class="iconify" ${plan.custom_domain == '1' ? 'data-icon="akar-icons:check"' : 'data-icon="akar-icons:cross"'} data-inline="false"></span>Custom Domain</li>

                                          <li class="${plan.sub_domain == '0' ? 'active' : ''}"><span class="iconify" ${plan.sub_domain == '1' ? 'data-icon="akar-icons:check"' : 'data-icon="akar-icons:cross"'} data-inline="false"></span>Sub Domain</li>
                                        
                                          <li><span class="iconify" data-icon="akar-icons:check" data-inline="false"></span>Storage Limit: ${plan.storage_size} GB</li>

                                          <li><span class="iconify" data-icon="akar-icons:check" data-inline="false"></span>Post Limit: ${plan.post_limit}</li>

                                          <li class="${plan.online_businesscard == '0' ? 'active' : ''}"><span class="iconify" ${plan.online_businesscard == '1' ? 'data-icon="akar-icons:check"' : 'data-icon="akar-icons:cross"'} data-inline="false"></span>Online Business Card</li>

                                          <li class="${plan.online_cv == '0' ? 'active' : ''}"><span class="iconify" ${plan.online_cv == '1' ? 'data-icon="akar-icons:check"' : 'data-icon="akar-icons:cross"'} data-inline="false"></span>Online CV</li>

                                          <li class="${plan.qrcode == '0' ? 'active' : ''}"><span class="iconify" ${plan.qrcode == '1' ? 'data-icon="akar-icons:check"' : 'data-icon="akar-icons:cross"'} data-inline="false"></span>QR Code</li>

                                         
                                      </ul>
                                  </div>
                                  <div class="pricing-btn">
                                      <a href="${plan.rotue}/register">Get Started</a>
                                  </div>
                              </div>
                          </div>`;
            });
            $(".pricing-table").html(planHtml);
            //choice-image section
            let choiceImgHtml = '';
            data.template_image.forEach(template_image => {
                choiceImgHtml += `<div class="col-lg-3">
                                  <div class="single-choice mb-30">
                                      <div class="choice-img">
                                          <a href="${template_image.link}"><img class="img-fluid" src="${template_image.img}" alt="template image"></a>
                                      </div>
                                  </div>
                              </div>`;
            });
            $(".choice-image").html(choiceImgHtml);

            //blog section
            let blog = '';
            data.blogs.forEach(row => {
                blog += `<div class="col-lg-4">
                    <div class="single-news">
                        <div class="news-img">
                            <a href="${row.url}"><img class="img-fluid" src="${row.image}" alt=""></a>
                        </div>
                        <div class="news-content">
                            <div class="news-date">
                                <span><span class="iconify" data-icon="fontisto:date" data-inline="false"></span> ${row.date}</span>
                                
                            </div>
                            <div class="news-title">
                                <a href="${row.url}"><h4>${row.title}</h4></a>
                            </div>
                            <div class="news-des">
                                <p>${row.excerpt}</p>
                            </div>
                            <div class="news-action">
                                <a href="${row.url}">Read More <span class="iconify" data-icon="bytesize:arrow-right" data-inline="false"></span></a>
                            </div>
                        </div>
                    </div>
                </div>`;
            });
            $(".blog_area").html(blog);
            //companey-section
            let companyHtml = '';

            data.company.forEach(company => {
                companyHtml += `<div class="col-2">
                                  <div class="client-logo">
                                      <a href="${company.link}">
                                      <img src="${company.img}" alt="" style="height: 70px; width: 110px;">
                                      </a>
                                  </div>
                              </div>`;
            });
            $(".companey-section").html(companyHtml);
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 0,
                items: 6,
                navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                nav: true,
                dots: false,
                responsive: {
                    0: {
                        items: 3
                    },
                    767: {
                        items: 5
                    },
                    992: {
                        items: 6
                    }
                }
            })

        }
    });
}