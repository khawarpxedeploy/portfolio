"use strict";

 /*--------------------------------
        Blog Lists Data Get
    --------------------------------*/
const tenant_url = document.getElementById("base_url").value;
information(`${tenant_url}/bloglist`);

function information(url) {
  $.ajax({
      url: url
      , type: "get"
      , dataType: "json"
      , success: function(response) {
         let blogHtml = '';
        response.data.forEach(blog => {
          blogHtml += `
          <div class="col-lg-6">
            <div class="single-news">
                <div class="news-img">
                    <a href="${blog.url}">
                        <img class="img-fluid" src="${blog.img}" alt="">
                    </a>
                </div>
                <div class="news-content">
                    <div class="news-title">
                        <a href="${blog.url}">
                            <h4>${blog.title}</h4>
                        </a>
                    </div>
                    <div class="news-date-author">
                        <div class="news-date">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" class="iconify" data-icon="uil:calender" data-inline="false" style="transform: rotate(360deg);"><path d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3zm1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1z" fill="currentColor"></path></svg>${blog.date}
                        </div>
                    </div>
                    <div class="news-des">
                        <p>${blog.des}</p>
                    </div>
                    <div class="news-btn">
                        <a href="${blog.url}">Read More <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" class="iconify" data-icon="bx:bx-right-arrow-circle" data-inline="false" style="transform: rotate(360deg);"><path d="M11.999 1.993c-5.514.001-10 4.487-10 10.001s4.486 10 10.001 10c5.513 0 9.999-4.486 10-10c0-5.514-4.486-10-10.001-10.001zM12 19.994c-4.412 0-8.001-3.589-8.001-8s3.589-8 8-8.001C16.411 3.994 20 7.583 20 11.994c-.001 4.411-3.59 8-8 8z" fill="currentColor"></path><path d="M12 10.994H8v2h4V16l4.005-4.005L12 7.991z" fill="currentColor"></path></svg></a>
                    </div>
                </div>
            </div>
        </div> `;
        });
       $(".blog_area").html(blogHtml);
        
        render_pagination('.pagination_links',response.links)
      }
    });
  }

  function render_pagination(target,data){
    $('.page-item').remove();
    if (data.length <= 3) {
      return true;
    }
   $.each(data, function(key,value){
        if(value.label === '&laquo; Previous'){
            if(value.url === null){
                var is_disabled="disabled"; 
                var is_active=null;
            }
            else{
                var is_active='page-link-no'+key;
                var is_disabled='';
            }
            var html='<li  class="page-item"><a '+is_disabled+' class="fas fa-angle-left page-link '+is_active+'" href="javascript:void(0)" data-url="'+value.url+'"></a></li>';
        }
        else if(value.label === 'Next &raquo;'){
            if(value.url === null){
                var is_disabled="disabled"; 
                var is_active=null;
            }
            else{
                var is_active='page-link-no'+key;
               var is_disabled='';
            }
            var html='<li class="page-item"><a '+is_disabled+'  class="fas fa-angle-right page-link '+is_active+'" href="javascript:void(0)" data-url="'+value.url+'"></a></li>';
        }
        else{
            if(value.active==true){
                var is_active="active";
                var is_disabled="disabled";
                var url=null;

            }
            else{
                var is_active='page-link-no'+key;
                var is_disabled='';
                var url=value.url;
            }
            var html='<li class="page-item '+is_active+'"><a class="page-link '+is_active+'" '+is_disabled+' href="javascript:void(0)" data-url="'+url+'">'+value.label+'</a></li>';
        }
        if(value.url !== null){
          $(target).append(html);
        }
        
   });
}


$(document).on('click','.page-link',function() {
    var url = $(this).data('url');
    if(url != null){
        information(url);
    }
});