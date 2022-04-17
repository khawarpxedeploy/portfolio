(function($) {
    "use strict";

    $('.iconpicker2').on('change', function(e) {
        var counterId = ($(this).attr('data-counter2'));
        $(".icon2_" + counterId).val(e.icon);
    });

    var x2 = 0; //Initial field counter is 1
    var count2 = 100;
    var maxField2 = 10; //Input fields increment limitation
    var addButton2 = $('.add_button2'); //Add button selector
    var wrapper2 = $('.field_wrapper2'); //Input field wrapper
    //Once add button is clicked
    $(addButton2).on('click', function() {
        //Check maximum number of input fields
        if (x2 < maxField2) {
            //Increment field counter
            var fieldHTML2 = `<div class='row'>
                                <div class="col-md-5 "><br>
                                    <div class="input-group form-group">
                                        <input type="text" required readonly class="form-control icon_${count2}" aria-describedby="button-addon2${count2}" name="social[${count2}][icon]" height="40">
                                        <button class="btn btn-outline-primary mb-0 iconpicker" data-counter="${count2}" data-icon="fas fa-home" role="iconpicker" type="button" id="button-addon2${count2}"></button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <br>
                                    <input type="text" required class="form-control" name="social[${count2}][link]">
                                </div>
                                <div class="col-md-1">
                                    <a href="javascript:void(0);" class="remove_button2 text-xxs mr-2 btn btn-danger mb-0 btn-md mt-4 text-xxs" title="Add field"> <i class="fas fa-times"></i></a>
                                </div><div>`; //New input field html
            x2++;
            count2++;
            $(wrapper2).append(fieldHTML2); //Add field html
            loadIconPicker();
            
        }


    });
    //Once remove button is clicked
    $(wrapper2).on('click', '.remove_button2', function(e) {
        e.preventDefault();
        $(this).parent('div').parent('div.row').remove(); //Remove field html
        x--; //Decrement field counter
    });


    var a = 0; //Initial field counter is 1
    var count3 = 100;
    var maxField2 = 10; //Input fields increment limitation
    var addButton = $('.add_button3'); //Add button selector
    var wrapper = $('.field_wrapper3'); //Input field wrapper
    //Once add button is clicked
    $(addButton).on('click', function() {
        //Check maximum number of input fields
        if (a < maxField2) {
            //Increment field counter
            var fieldHTML2 = `<div class='row'>
                                <div class="col-md-4"><br>
                                    <div class="input-group form-group">
                                        <input type="text" required readonly class="form-control icon_${count3}" aria-describedby="button-addon4${count3}" name="counter[${count3}][icon]" height="40">
                                        <button class="btn btn-outline-primary mb-0 iconpicker" data-counter="${count3}" data-icon="fas fa-home" role="iconpicker" type="button" id="button-addon4${count3}"></button>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <br>
                                    <input type="text" required class="form-control" name="counter[${count3}][label]">
                                </div>
                                <div class="col-md-4">
                                    <br>
                                    <input type="text" required class="form-control" name="counter[${count3}][count]">
                                </div>
                                <div class="col-md-1">
                                    <a href="javascript:void(0);" class="remove_button3 text-xxs mr-2 btn btn-danger mb-0 btn-md mt-4 text-xxs" title="Add field"> <i class="fas fa-times"></i></a>
                                </div><div>`; //New input field html
            a++;
            count3++;
            $(wrapper).append(fieldHTML2); //Add field html
            loadIconPicker();
        }
    });
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button3', function(e) {
        e.preventDefault();
        $(this).parent('div').parent('div.row').remove(); //Remove field html
        a--; //Decrement field counter
    });
  
})(jQuery);	

/*----------------------
        loadIconPicker
    ----------------------*/

$('.iconpicker').on('change', function(e) {
    var counterId = ($(this).attr('data-counter'));
    $(".icon_" + counterId).val(e.icon);


});

function loadIconPicker() {
    $('.iconpicker').iconpicker();
    $('.iconpicker').on('change', function(e) {
        var counterId = ($(this).attr('data-counter'));
        $(".icon_" + counterId).val(e.icon);
    });
}

 // multiple tag title 
 var x = 0; //Initial field counter is 1
 var count = 100;
 var maxField = 10; //Input fields increment limitation
 var addButton = $('.add_button'); //Add button selector
 var wrapper = $('.field_wrapper'); //Input field wrapper

 //Once add button is clicked
 $(addButton).on('click', function() {
     //Check maximum number of input fields
     if (x < maxField) {
         //Increment field counter
         var fieldHTML = `<div class='row'><div class="col-md-11">
                         <br>
                         <input type="text" required class="form-control" name="title[]" value="">
                         </div>
                         <div class="col-md-1">
                             <a href="javascript:void(0);" class="remove_button text-xxs mr-2 btn btn-danger mb-0 btn-md mt-4 text-xxs" title="Add field"> <i class="fas fa-times"></i></a>
                         </div><div>`; //New input field html
         x++;
         count++;
         $(wrapper).append(fieldHTML); //Add field html
     }
 });
 //Once remove button is clicked
 $(wrapper).on('click', '.remove_button', function(e) {
     e.preventDefault();
     $(this).parent('div').parent('div.row').remove(); //Remove field html
     x--; //Decrement field counter
 });