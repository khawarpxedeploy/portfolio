(function ($) {
	"use strict";

    /*------------------------
        Summernote Active
      -----------------------------*/
    $('#summernote').summernote({
        tabsize: 2
        , height: 100
    });

    /*------------------------
        Custom File Input
      -----------------------------*/
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    $('.select2').select2();

})(jQuery);