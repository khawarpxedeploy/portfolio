(function($) {
    "use strict";

    /*-----------------
            Delete Chat
        ---------------------*/
    $('.paymentform').on('submit', function(e) {
        $('.paymentbtn').attr("disabled", "disabled");
        $('.paymentbtn').text("Please wait...");
    });

})(jQuery);	