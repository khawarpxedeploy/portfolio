("use strict");


    /*--------------------
            CV Download
        ------------------------*/
    let downloadurl = $('#cvdownload').val();
    let counter = 0;
    cvfetch() // Fetch prev value from db
    let form = false;
  
    selectedTheme($('.theme_name:first').text())
    $('.theme-preview:first').addClass('active');
    $('#select-mode').val('light')

    $('#downloadURL').on('click', function(e){
        form = true;
        e.preventDefault();
        let href = $(this).attr('href')
        store().done(function(data){
            if(data == 'success'){
                // window.location.href = href
                window.open(href, 'blank');
            }
       });
    })


    $.each($('.custom-select'), function(key, value) {
        selected($(this), $('option:selected', this).text())
    });
 

    /*--------------------
            Select Theme
        ------------------------*/
    selectedTheme($('.theme_name:first').text())

    $(document).on('click','.cv-field-add', function(){
        var target = $(this).data('html');
        var length = target == 'accomplishment' ? $('ul.timeline').children().length : $(`.${target}HTML`).children().length;

        if (target == 'accomplishment') {
            $('ul.timeline').append(renderHTML(target))
            return
        }
       $(`.${target}HTML`).append(renderHTML(target))
    })


    $(document).on('click', '.cv-field-add-more', function() {
        var target = $(this).data('html');
        if (target == 'accomplishment') {
            $('ul.timeline').append(renderHTML(target))
            return
        }
        $(`.${target}HTML`).append(renderHTML(target))
    })

    $(document).on('click', '.cv-field-remove', function () {
        let target = $(this).closest('.cv-field-parent').data('type')
        $(this).closest('.cv-field-parent').remove();
        resetCounter(target)
        store()
    })

    /*--------------------
            Reset Counter
        ------------------------*/
    function resetCounter(target) {
        counter = 0;
        if (target == 'accomplishment') {
            html = $('.timeline').children();
        } else if (target == 'skill') {
            return
        } else {
            html = $(`.${target}HTML`).children();
        }
        html.each(function () {
            var input = $(this).find(':input');
            input.each(function (k, value) {
                var name = $(this).data('name')
                var value = $(this).val()
                $(this).val(value)
                $(this).attr('name',`${target}[${counter}][${name}]`)
            })
            counter++;
        });
    }

    $(document).on('change', '.custom-select', function() {
        selected($(this), $('option:selected', this).text())
    })

     /*--------------------
            Theme Preview
        ------------------------*/
    $('.theme-preview').on('click', function() {
        let theme = $(this).data('theme')
        $('.theme-preview').removeClass('active')
        $(this).addClass('active')
        let active = $(this).find('.theme_name').text();
        $('#theme').val(theme);
        selectedTheme(active)
        renderForm(theme)
    })

    $('.selected-item.theme').on('click', function() {
        $('.themes').toggleClass('show');
    })
    
    /*--------------------
            Select Color
        ------------------------*/
    $('#select-color').on('change', function() {
        $('#color').val($(this).val());
        
        if($(this).val() == 'custom'){
            colorPicker();
        }else{
            setSidebarColor($(this).val())
        }
    })

    /*--------------------
            Select Model
        ------------------------*/
    $('#select-mode').on('change', function() {
        let color = '#ffffff';
        $('#mode').val($(this).val());
        if($(this).val() == 'dark') {
            color = '#434343';
        }
        setBgColor(color);
        setColor(color);
        $('#select-color').prop('selectedIndex',0);
    })


    /*------------------------
            Select Language
        ------------------------*/
    $('#select-language').on('change', function() {
        var lang = $('#language').val($(this).val());
        setlanguage($(this).val())
        // store()
    })


     /*------------------------
            Select Language
        ------------------------*/
    window.onload = () => {
        // run in onload
        setTimeout(() => {
            let theme = $('.theme-preview.active').data('theme');
            renderForm(theme)
        }, 300)
    }

    /*------------------------
            Render Form
        ------------------------*/
    function renderForm(theme){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
           return $.ajax({
                type: 'get',
                data: {theme : theme},
                url: $('#cvformtheme').val(),
                success: function(response){ 
                    if(response){

                        $('#renderform').html(response)   
                    }
                },
                error: function(xhr, status, error) 
                {
                    console.log(error);
                }
        }).then(function(){
            $(".loader").hide();
            cvfetch()
        })
    }
    
    /*------------------------
            Set Language
        ------------------------*/
    function setlanguage(lang) {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
            type: 'get',
            data: {language : lang},
            url: $('#cvlanguageurl').val(),
            success: function(response){ 
                for (const [key, value] of Object.entries(response)) {
                    $('.'+ key.toLowerCase()).html(value)
                }
            },
            error: function(xhr, status, error) 
            {
                
            }
        })
    }

    /*------------------------
            Theme Active
        ------------------------*/
    $('.main-content').on('click', function (e) {
        var classList = e.target.classList;
        if (classList.contains('selected-item')) {
            return
        }
        if (!classList.contains('theme-img') && !classList.contains('theme-preview') && !classList.contains('navbar-nav')) {
            if ( $('.themes').hasClass('show')) {
                $('.themes').removeClass('show');
            } 
        }
    })

    function capitalize(string) {
        return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
    }

    /*------------------------
            Reset Form
        ------------------------*/
    $(document).on('click', '#resetform', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?'
            , text: "You want to reset!"
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                reset();
                renderForm($('.theme-preview.active').data('theme'))
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
            
            }
        })

    })


    function selected(target, selected) {
        target.prev().children('.value').text(selected)
    }

    function selectedTheme(active) {
        $('.selected-item.theme .value').text(active);
    }

    function success(){
        
    }

    $(document).on('click', '.cv-image',function(){
        $('#profile-image').trigger('click'); 
    })

    $(document).on('change','#profile-image', function(e){
        let frame = $('.cv-image');
        frame.attr('src', URL.createObjectURL(e.target.files[0]));
    })
    
    /*------------------------
            CV Data Fetch
        ------------------------*/
    function cvfetch(data) {
        let active = ''
        let color = ''
        let mode = ''
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
            type: 'GET',
            url: $('#cvfetchurl').val(),
            dataType: 'json',
            success: function(response){ 
                if(response.cv == ''){return}
                let data = response.cv
                let languageData = response.language;
                $('[name="name"]').val(data.name ?? '')
                $('[name="role"]').val(data.role ?? '')
                $('[name="skill"]').text(data.skill ?? '')
                $('[name="language"]').val(data.language ?? '')
                $('[name="address"]').val(data.address ?? '')
                $('[name="customfield"]').text(data.customfield ?? '')
                $('[name="custommultiheader"]').val(data.custommultiheader ?? '')
                $('[name="about"]').text(data.about ?? '')
                $('[name="reference"]').text(data.reference ?? '')
                let education = data.education ? renderHTML('education',data.education) : '';
                let reference = data.reference ? renderHTML('reference',data.reference) : '';
                let contact = data.contact ? renderHTML('contact',data.contact) : '';
                let accomplishment = data.accomplishment ? renderHTML('accomplishment',data.accomplishment) : '';
                let experience = data.experience ? renderHTML('experience',data.experience) : '';
                let custom = data.custom ? renderHTML('custom',data.custom) : '';
                let skill = data.skill ? renderHTML('skill',data.skill) : '';
                $('.educationHTML').append(education);
                $('.contactHTML').append(contact);
                $('.accomplishmentHTML .timeline').append(accomplishment);
                $('.experienceHTML').append(experience);
                $('.customHTML').append(custom);
                $('.skillHTML').append(skill);
                $('.referenceHTML').append(reference);

                var placeholderImage = $('#placeholderImage').val();

                if(response.image){
                    $('.cv-image').attr('src', response.image);
                }else{
                    $('.cv-image').attr('src', placeholderImage);
                }
                
                active = data.theme
                mode = data.mode
                color = data.color
         
                $('#color').val(data.color);
                
                $('#mode').val(data.mode);
                $('#language').val(data.cvlanguage);

                $('#select-mode').val(data.mode)
                $('#select-language').val(data.cvlanguage)

                let option = ''
                
                $("#select-color option").each(function() {
                    if($('#select-color option').hasClass('customColorOption')) return;
                    if($(this).val() == data.color){
                        $('#select-color').val(data.color)
                    }else{
                        option = '<option class="customColorOption" value='+data.color+' selected>'+hexToName(data.color)+'</option>'
                    }
                });

                if(option != ''){
                    $('#select-color').append(option)
                }

               
                let arr = new Array;
                for (let [key, value] of Object.entries(languageData)) {
                    if(key == data.cvlanguage){
                        arr.push(value)
                    }
                }

                if(arr.length > 0){
                    for (let [key, value] of Object.entries(arr[0])) {
                       let titleClass = $('.'+key.toLowerCase());
                       if(titleClass){
                            titleClass.html(value)
                       }
                    }
                }

                $.each($('.cv-field'), function(key,value){
                    var data = $(this).attr("data-placeholder");
                    if ($(this).text().length != 0) {
                        $(this).attr("data-placeholder","");
                    }else{
                        $(this).attr("data-placeholder",data);
                    }
                })
            },
            error: function(xhr, status, error) 
            {
                console.log(error);
            }
            }).then(function(){
                if($('#theme').val() == ''){
                    $('#theme').val(active) 
                    $('.theme-preview').removeClass('active')
                    $.each($('.theme-preview'), function(key, value){
                        var theme = $(this).data("theme");
                        if(active == theme){
                            $(this).addClass('active')
                        }
                    });
                }
            let themename = $('.theme-preview.active').data('name');
            let theme = themename[0].toUpperCase() + themename.slice(1)
            selectedTheme(theme)
             
                
            let bgColor = '#ffffff';
            if(mode == 'dark') bgColor = '#434343';
            setBgColor(bgColor)
            if(color == '') color = '#ffffff';
            setColor(color)
    })
}



 /*------------------------
        CV Data Reset
    ------------------------*/
function reset() {
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax({
        type: 'POST',
        url: $('#cvreseturl').val(),
        success: function(response){ 
            
        },
        error: function(xhr, status, error) 
        {
            console.log(error);
        }
    })
}

/*------------------------
        Data Store
    ------------------------*/
function store() {
    let form = document.getElementById('cvform');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        return $.ajax({
            type: 'POST',
            url: $('#cvstoreurl').val(),
            data: new FormData(form),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response){ 
                
        },
        error: function(xhr, status, error) 
        {
                
        }
    })
}
    
/*------------------------
        Render Data
    ------------------------*/
function renderHTML(target, data='') {
    if (target == 'education') {
        counter = $('.educationHTML').children().length
        let html = ''
        if (data.length > 0) {
        for (const k in data) {
            let item = data[k]
            html += `<div class='cv-field-parent mb-3 resume-contact-form' data-type="education">
            <div class="resume-contact-select-area">
            <div class="resume-text-content">
            <input value=${item.degree} name=education[${k}][degree] data-name='degree' class="w-100  cv-field" placeholder="Course (Degree)">
            </div>
            ${renderButton()}
            </div>
            <div class="resume-text-content">

            <input value=${item.duration} data-name='duration' name="education[${k}][duration]" class="w-100  cv-field" placeholder="From - Until" data-name-multi='duration'>

            </div>
            <div class="resume-text-content mt-2">

            <input class="w-100  cv-field " value=${item.institute} data-name='institute' name="education[${k}][institute]" placeholder="University,School...">

            </div>

            <div class="resume-text-content mt-2">

            <textarea class="w-100  cv-field " data-name='institute' name="education[${k}][description]" placeholder="Description/CGPA etc...">${item.description}</textarea>

            </div>
            </div>`
        }
        }else{
            html += `<div class='cv-field-parent mb-3 resume-contact-form' data-type="education">
            <div class=" resume-contact-select-area">
            <div class="resume-text-content">
            <input name=education[${counter}][degree] data-name='degree' class="w-100  cv-field " placeholder="Course (Degree)">
            </div>
            ${renderButton()}
            </div>
            <div class="resume-text-content">
            <input data-name='duration' name="education[${counter}][duration]" class="w-100  cv-field " placeholder="From - Until" data-name-multi='duration'>
            </div>
            <div class="resume-text-content mt-2">
            <input class="w-100  cv-field "  data-name='institute' name="education[${counter}][institute]" placeholder="University,School...">
            </div>
            <div class="resume-text-content mt-2">

            <textarea class="w-100  cv-field " data-name='institute' name="education[${counter}][description]" placeholder="Description/CGPA etc..."></textarea>


            </div>
            </div>`
        }
        counter++
        return html
    }else if (target == 'contact') {
        counter = $('.contactHTML').children().length
        let html = ''
        if (data.length > 0) {
            for (const k in data) {
                let item = data[k]
                html += `<div class='cv-field-parent mb-3 resume-contact-form ' data-type="contact"><div class="contacttype resume-contact-select-area">
                <select class="w-100 customcvselect form-select" data-name='key' name=contact[${k}][key]>
                <option value="linkedin" ${item.key == "linkedin" ? "selected" : ''} >LinkedIn</option>
                <option value="website" ${item.key == "website" ? "selected" : ''} >Website</option>
                <option value="contact" ${item.key == "contact" ? "selected" : ''} >Phone</option>
                <option value="email" ${item.key == "email" ? "selected" : ''} >Email</option>
                <option value="github" ${item.key == "github" ? "selected" : ''} >Github</option>
                </select>
                ${renderButton()}
                </div>
                <div class="resume-text-content"> <input data-name='value' class="single cv-field" value="${item.value}" name=contact[${k}][value]  placeholder="Your website,linkedin,github,etc.."></div>
                </div>`
                }
            }else{
            html += `<div class='cv-field-parent mb-3 resume-contact-form' data-type="contact"><div class="contacttype resume-contact-select-area">
            <select class="w-100  customcvselect form-select" data-name='key' name=contact[${counter}][key]>
            <option value="linkedin">LinkedIn</option>
            <option value="website">Website</option>
            <option value="contact">Phone</option>
            <option value="github">Github</option>
            <option value="email">Email</option>
            </select>
            ${renderButton()}
            </div>
            <div class="resume-text-content"><input class="single cv-field"  data-name='value' name=contact[${counter}][value]  placeholder="Your website,linkedin,github,etc.."></div></div>`
        
        }
        counter++
        return html
    }else if (target == 'custom') {
        counter = $('.customHTML').children().length
        let html = ''
        if (data.length > 0) {
            for (const k in data) {
                let item = data[k]
                html+=`<div class='cv-field-parent mb-3 resume-contact-form' data-type="custom">
                <div class="resume-contact-select-area">
                <div class="resume-text-content">
                <input class="w-100  cv-field" placeholder="Custom Title" value="${item.title}" data-name="title" name="custom[${k}][title]">
                </div>
                ${renderButton()}
                </div>
                <div class="resume-text-content mb-2">
                <input name="custom[${k}][duration]" data-name='duration' value="${item.duration}" class="w-100  cv-field " placeholder="From - Until">
                </div>
                <div class="resume-text-content">
                <input value="${item.description}" data-name='description' name="custom[${k}][description]" class=" cv-field  w-100" placeholder="Description">
                </div>`
            }
        }else{   
            html+=`<div class='cv-field-parent mb-3 resume-contact-form' data-type="custom">
            <div class="resume-contact-select-area">
            <div class="resume-text-content">
            <input class="w-100  cv-field " placeholder="Custom Title" data-name="title" name="custom[${counter}][title]">
            </div>
            ${renderButton()}
            </div>
            <div class="resume-text-content mb-2">
            <input name="custom[${counter}][duration]" data-name='duration' class="w-100  cv-field " placeholder="From - Until">
            </div>
            <div class="resume-text-content">
            <input data-name='description' name="custom[${counter}][description]" class=" cv-field  w-100" placeholder="Description">
            </div>`
        }
        counter++;
        return html
    } else if (target == 'experience') {
        counter = $('.experiences').length
        
        let html = ''
        if (data.length > 0) {
            for (const k in data) {
                let item = data[k]
                html += `<div class='cv-field-parent mb-3 resume-contact-form experiences' data-type="experience">
                <div class="resume-contact-select-area">
                <div class="resume-text-content">
                <input data-name='company' name="experience[${k}][company]" class="cv-field" placeholder="Company | Role" value="${item.company}">
                </div>
                ${renderButton(target)}
                </div>
                
                <div class="resume-text-content">
                <input class="cv-field" data-name='role' placeholder="Your role" name="experience[${k}][role]" value="${item.role}">
                </div>

                <div class="resume-text-content mt-2">
                <input class="cv-field" data-name='duration' placeholder="From - Until" name="experience[${k}][duration]" value="${item.duration}">
                </div>
    
                <div class="resume-contact-select-area mt-2">
                <span class="jobtype">
                <select class="customcvselect form-select w-100" data-name='type' name="experience[${k}][type]">
                    <option value="1" ${item.type == 1 ? 'selected' : ''}>Part Time</option>
                    <option value="2" ${item.type == 2 ? 'selected' : ''}>Full Time</option>
                    <option value="3" ${item.type == 3 ? 'selected' : ''}>Contract</option>
                    <option value="4" ${item.type == 4 ? 'selected' : ''}>Student</option>
                    <option value="0" ${item.type == 5 ? 'selected' : ''}>Do not Display</option>
                </select>
                </span>
                </div>
                
                <div class="resume-text-content">
                <textarea name="experience[${k}][description]" data-name='description' row=5 class="cv-field" contenteditable="true" placeholder="Show your positive experiences. Use Strong verbs like created,introduced,increased">${item.description}</textarea>
                </div>`;
                    counter++
                }
            }else{
                html += `<div class='cv-field-parent mb-3 resume-contact-form experiences' data-type="experience">
                <div class="resume-contact-select-area">
                <div class="resume-text-content">
                <input data-name='company' name="experience[${counter}][company]" class="w-100  cv-field " placeholder="Company | Role">
                </div>
                ${renderButton(target)}
                </div>
                
                <div class="resume-text-content">
                <input class="cv-field" data-name='role' placeholder="Your role" name="experience[${counter}][role]">
                </div>

                <div class="resume-text-content mt-2">
                <input class=" cv-field " data-name='duration' placeholder="From - Until" name="experience[${counter}][duration]">
                </div>
    
                <div class="resume-contact-select-area mt-2">
                <span class="jobtype">
                <select class="customcvselect form-select w-100" data-name='type' name="experience[${counter}][type]">
                    <option value="1">Part Time</option>
                    <option value="2">Full Time</option>
                    <option value="3">Contract</option>
                    <option value="4">Student</option>
                    <option value="0">Do not Display</option>
                </select>
                </span>
                </div>
                
                <div class="resume-text-content">
                <textarea name="experience[${counter}][description]" data-name='description' row=5 class="w-100  cv-field " contenteditable="true" placeholder="Show your positive experiences. Use Strong verbs like created,introduced,increased"></textarea>
                </div>`;
                    counter++
        }
        console.log(counter)
        return html;
        
    }else if (target == 'reference') {
        counter = $('.referenceHTML').children().length
        let html = ''
        if (data.length > 0) {
            for (const k in data) {
                let item = data[k]
                html += `<div class='cv-field-parent mb-3 resume-contact-form' data-type="reference">
                <div class="resume-contact-select-area">
                <div class="resume-text-content">
                <input data-name='name' name="reference[${k}][name]" class="cv-field" placeholder="Name" value="${item.name}">
                </div>
                ${renderButton(target)}
                </div>
                
                <div class="resume-text-content">
                <input class="cv-field" data-name='role' placeholder="Role" name="reference[${k}][role]" value="${item.role}">
                </div>

                <div class="resume-text-content mt-2">
                <input class="cv-field" data-name='phone' placeholder="Phone" name="reference[${k}][phone]" value="${item.phone}">
                </div>
                
                <div class="resume-text-content mt-2">
                <input class="cv-field" data-name='email' placeholder="Email" name="reference[${k}][email]" value="${item.email}">
                </div>`
                }
            }else{
                html += `<div class='cv-field-parent mb-3 resume-contact-form' data-type="reference">
                <div class="resume-contact-select-area">
                <div class="resume-text-content">
                <input data-name='name' name="reference[${counter}][name]" class="cv-field" placeholder="Name" value="">
                </div>
                ${renderButton(target)}
                </div>
                
                <div class="resume-text-content">
                <input class="cv-field" data-name='role' placeholder="Role" name="reference[${counter}][role]" value="">
                </div>

                <div class="resume-text-content mt-2">
                <input class="cv-field" data-name='phone' placeholder="Phone" name="reference[${counter}][phone]" value="">
                </div>
                
                <div class="resume-text-content mt-2">
                <input class="cv-field" data-name='email' placeholder="Email" name="reference[${counter}][email]" value="">
                </div>`
        }
        counter++
        return html;
    } else if (target == 'accomplishment') {
        counter = $('.accomplishmentHTML .timeline').children().length
        let html = ''
        if (data.length > 0) {
            for (const k in data) {
                let item = data[k]
                html += `<li class="cv-field-parent resume-contact-form" data-type="accomplishment">
                <div class="resume-contact-select-area">
                <div class="resume-text-content">
                <input data-name='duration' value="${item.duration}" name="accomplishment[${k}][duration]" class="mb-2 cv-field  w-100" placeholder="From - Until">
                </div>
                ${renderButton()}
                </div>
                <div class="resume-text-content">
                <input class="w-100  cv-field " value="${item.description}" data-name='description' name="accomplishment[${k}][description]" placeholder="Description">
                </div>
                </li>`
                
                }
            }else{
            html += `<li class="cv-field-parent resume-contact-form" data-type="accomplishment">
            <div class="resume-contact-select-area">
            <div class="resume-text-content">
            <input data-name='duration' name="accomplishment[${counter}][duration]" class="w-100 mb-2  cv-field  w-100" placeholder="From - Until">
            </div>
            ${renderButton()}
            </div>
            <div class="resume-text-content">
            <input class="w-100  cv-field " data-name='description' name="accomplishment[${counter}][description]" placeholder="Description">
            </div></li>`
            counter++
        }
        
        return html;
    }else if (target == 'skill') {
        counter = $('.skillHTML').children().length
        let html = ''
        if (data.length > 0) {
            for (const k in data) {
                let item = data[k]
                html += `<div class='cv-field-parent mb-3 resume-contact-select-area' data-type="skill"> <div class="resume-text-content"><input class="w-100  cv-field " placeholder="HTML, Photoshop,..." name="skill[]" value=${item}></div>${renderButton()}</div>`
                }
            }else{
                html += `<div class='cv-field-parent mb-3 resume-contact-select-area' data-type="skill"> <div class="resume-text-content"><input class="w-100  cv-field " placeholder="HTML, Photoshop,..." name="skill[]"></div>${renderButton()}</div>`
        }
        counter++
        return html;
    }
}


/*------------------------
        Render Button
    ------------------------*/
function renderButton() {
    return `<span class="cv-field-remove resetform"><span class="iconify" data-icon="fluent:delete-24-filled" data-inline="false"></span></span>`
}


/*------------------------
        Set Color
    ------------------------*/
var hexDigits = new Array("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"); 

function rgb2hex(rgb) {
    rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
}
function hex(x) {
    return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
}

function colorPicker(){
    $('#select-color').remove('.custom_color');
    $('#color-picker')[0].click();
    $('#color-picker').on('input', function(){
        let color = $('#color-picker').val();
        setSidebarColor(color)
        $("#select-color .custom_color").remove();
        $('#select-color').append('<option class="custom_color" value='+color+' selected>'+hexToName(color)+'</option>')
    })
}

function hexToName(color){
    var n_match = ntc.name(color);
    n_rgb = n_match[0]; // RGB value of closest match
    n_name = n_match[1]; // Text string: Color name
    n_exactmatch = n_match[2]; // True if exact color match
    
    return n_name;
}

function getContrastColor(value) {
    const hexCode = value.charAt(0) === '#' 
                ? value.substr(1, 6)
                : value;

    const hexR = parseInt(hexCode.substr(0, 2), 16);
    const hexG = parseInt(hexCode.substr(2, 2), 16);
    const hexB = parseInt(hexCode.substr(4, 2), 16);
    // Gets the average value of the colors
    const contrastRatio = (hexR + hexG + hexB) / (255 * 3);

    return contrastRatio >= 0.5 ? 'black' : 'white';
}

function setBgColor(color){
    $('.layout').css('background',color);
}

function setColor(color){
    $('.sidebar').css('background',color)
}

function setSidebarColor(color){
    $('.sidebar').css('background',color)
    $('.single-sidebar').css('background',color)
    let contrast = getContrastColor(color);
    $('#color').val(color)
    let elements = document.querySelector('.sidebar').querySelectorAll("*");
    console.log(elements);
    const classNames = ['resume-add-more-btn','cv-field-remove','cv-field-add','iconify','cv-field']
    elements.forEach(input => {
        if (classNames.some(className => input.classList.contains(className))) return
        input.style.color = contrast;
        input.style.backgroundColor = color;
    });
}

/*------------------------
        Cv Button Disabled
    ------------------------*/
$('.cvbutton-disabled').on('click',function(){
    let url = $('#upgrate_plan_url').val();
    window.location.replace(url); 
});

/*---------------------------------------
        Resume Area show class remove
    -----------------------------------------*/
$('.resume-area').on('click',function(e) {
    $('.themes').removeClass('show');
});