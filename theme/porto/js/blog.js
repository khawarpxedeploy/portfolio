"use strict"

/*--------------------------------
        Data get by Ajax Request
    ----------------------------------*/
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
                            <a href="${blog.url}"><img class="img-fluid" src="${blog.img}" alt="${blog.title}"></a>
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
                            <div class="news-des">
                                <p>${blog.des}</p>
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