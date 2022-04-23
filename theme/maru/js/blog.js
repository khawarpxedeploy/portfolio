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
           <div class="col-lg-4">
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
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24" class="iconify" data-icon="uil:calender" data-inline="false" style="transform: rotate(360deg);"><path d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3zm1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1z" fill="currentColor"></path></svg> ${blog.date}
                    </div>

                </div>
                <div class="blog-des">
                    <p>${blog.des}</p>
                </div>
                <div class="blog-action">
                    <a href="${blog.url}">Read More <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16" class="iconify" data-icon="bi:arrow-right" data-inline="false" style="transform: rotate(360deg);"><g fill="currentColor"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path></g></svg></a>
                </div>
            </div>
        </div>
        </div>
        `;
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