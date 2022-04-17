(function ($) {
	"use strict";

    var x = 0; //Initial field counter is 1
    var count = 100;
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper


    // Once add button is clicked
    $(addButton).on('click', function() {
        //Check maximum number of input fields
        if (x < maxField) {
            //Increment field counter
            var fieldHTML = `<div class='row'><div class="col-md-3">
                            <br>
                            <input type="text" required class="form-control" name="data[${count}][type]" value="">
                            </div>
                            <div class="col-md-4">
                            <br>
                            <input type="text" required class="form-control" name="data[${count}][record]" value="">
                            </div>
                            <div class="col-md-4">
                                <br>
                                <input type="text" required class="form-control" name="data[${count}][value]" class="">
                            </div>
                            <div class="col-md-1">
                                <a href="javascript:void(0);" class="remove_button text-xxs mr-2 btn btn-danger mb-0 btn-sm text-xxs float-right" title="Add field">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                                    </svg>
                                </a>
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

})(jQuery);