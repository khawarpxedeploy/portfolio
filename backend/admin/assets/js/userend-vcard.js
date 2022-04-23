(function($) {
    "use strict";

    /*----------------------
            Field Wrapper
        ----------------------*/
    var wrapper = $('.field_wrapper');
    var count = 100;

    $('.info_icon').on('click', function() {
        var dataName = ($(this).attr('data-name'));
        var placeholder = ($(this).attr('data-placeholder'));
        var type = ($(this).attr('data-field-type'));
        var dataNameLow = dataName.charAt(0).toLowerCase() + dataName.slice(1);
        var fieldHTML = `<div class="col-lg-12">
                            <div class="row mt-4">
                            <input type="hidden" name="social[${count}][field_name]" value="${dataName}">
                                <div class="col-6 mt-2">
                                    <label for="" id="labelValue">${dataName}</label>
                                </div>
                                <div class="col-6 float-end mb-3">
                                    <a href="javascript:void(0)" onclick="$(this).parent().parent().remove();" class="remove_main_button float-right btn btn-danger"><i class="far fa-times-circle float-end"></i></a>
                                </div>
                                
                                <div class="col-12">
                                    <input type="${type}" id="inputValue1" class="form-control" name="social[${count}][value]" placeholder="${placeholder}">
                                </div>
                                <div class="col-12 mt-2">
                                    <input type="text" class="form-control" id="inputValue2" name="social[${count}][label]" placeholder="Label">
                                    <input name="social[${count}][type]" value="${dataNameLow}" type="hidden">
                                </div>
                            </div>
                            
                            </div>`;
        count++;
        $(wrapper).append(fieldHTML);
        var elem = document.getElementById('vcard-box');
        elem.scrollTop = elem.scrollHeight;
    });


    $('.single-vcard-section').on('click','label',function(e){
        $('.single-vcard-section label').removeClass('active');
        $(this).addClass('active');
    });

})(jQuery);

 /*----------------------
        Remove Btn
    ----------------------*/
function removebtn() {
    
}