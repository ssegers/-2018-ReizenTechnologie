/*$('#tripModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal

    var tripId = button.data('trip-id');
    // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this);
    /*
    modal.find('.modal-body #trip-name').val(tripName);
    modal.find('.modal-body #trip-year').val(tripYear);
    modal.find('.modal-body #trip-active').val(tripActive);
    modal.find('.modal-body #trip-price').val(tripPrice);
    modal.find('.modal-body #trip-id').val(tripId);
    modal.find('.modal-body #trip-mail').val(tripMail);

    var active = $('#trip-is-active');
    if (tripActive == 1) {
        active.prop('checked', true);
    }
    else {
        active.prop('checked', false);
    }
});*/

function addActiveOrganizer() {
    jQuery('#ajaxSubmit').click(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "{{ url('/getTrip') }}",
            method: 'post',
            data: {
                id: jQuery('#trip-id').val(),
                name: jQuery('#trip-name').val(),
                price: jQuery('#trip-price').val(),
                contact: jQuery('#trip-contact').val(),
                year: jQuery('#trip-year').val(),
                isActive: jQuery('#trip-is-active'),
            },
            success: function(result){
                if(result.errors)
                {
                    jQuery('.alert-danger').html('');

                    jQuery.each(result.errors, function(key, value){
                        jQuery('.alert-danger').show();
                        jQuery('.alert-danger').append('<li>'+value+'</li>');
                    });
                }
                else
                {
                    jQuery('.alert-danger').hide();
                    $('#open').hide();
                    //Hier vul ik de modal in denk ik, niet zeker hoe
                    //
                    $('#myModal').modal('hide');

                }
            }});
    });

};