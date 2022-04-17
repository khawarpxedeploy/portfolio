(function ($) {
	"use strict";

    /*----------------------
            dashboardurl
        ------------------------*/
    let url = $('#dashboardurl').val();
    $.ajax({
        url: url
        , type: "get"
        , dataType: "json"
        , success: function(data) {
            $('#portfolio-theme').html(data.portolioTheme);
            $('#vcard-theme').html(data.vcardTheme);
            let blogs = '';
            let projects = '';
            let blogediturl = $('#blogediturl').val();
            let projectediturl = $('#projectediturl').val();
            let asset_url = $('#asset_url').val();
            $('#vcard-img').attr('src',data.vcardScreenshot)
            $('#theme-img').attr('src',data.themeScreenshot)
            $('.themeloader').hide()
            $('.vcardloader').hide()
            data.blogs.forEach((blog, key) => {
                blogs += `<tr>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">${key +1}</p>
                            </td>
                            <td>
                                <img class="blog-img" src="${asset_url+'/'+blog.thum_image.value}"/>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">${blog.title.slice(0,30)}</p>
                            </td>
                            
                            <td>
                                <a class="btn btn-primary text-light px-3 mb-0" href="${blogediturl}/${blog.id}/edit"><i class="fas fa-pencil-alt text-light me-2" aria-hidden="true"></i>Edit</a>
                            </td>
                           </tr>` 
                });

                $('.blogsloader').hide();
                $('#recent-blogs').html(blogs)
                data.projects.forEach((project, key) => {
                    projects += `<tr>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">${key +1}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">${project.title.slice(0,40)}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">${project.link?.value}</p>
                                </td>
    
                                <td>
                                    <a class="btn btn-primary px-3 mb-0"
                                        href="${projectediturl}/${project.id}/edit"><i
                                            class="fas fa-pencil-alt text-light me-2"
                                            aria-hidden="true"></i>Edit</a>
                                </td>
                               </tr>` 
                    });
    
                $('.projectsloader').hide();
                $('#recent-projects').html(projects)
            
                let date =  new Date(data.plan?.will_expire).toDateString();
                $('#plan-name').html(data.plan?.plan?.name ?? 'Free')
                $('#total-blog').html(data.totalBlog)
                $('#total-project').html(data.totalProject)
                $('#storage').html(data.storageUsed) 
                $('#total_posts').html(data.total_posts) 
        }
    });
})(jQuery);	
