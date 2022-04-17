(function ($) {
	"use strict";

    /*-----------------------
            Delete Confirm
        --------------------------*/
    $('.delete-confirm').on('click', function(event) {
    const id = $(this).data('id');
    Swal.fire({
        title: 'Are you sure?'
        , text: "You want to delete this?"
        , icon: 'warning'
        , showCancelButton: true
        , confirmButtonColor: '#3085d6'
        , cancelButtonColor: '#d33'
        , confirmButtonText: 'Yes, delete it!'
        }).then((result) => {

            if (result.value) {
                
                event.preventDefault();
                document.getElementById('delete_form_' + id).submit();

            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled'
                    , 'Your Data is Save :)'
                    , 'error'
                )
            }
        })
    });

})(jQuery);