$(document).ready(function () {
    var contactSelect = $('#contact-select');
    var emailField = $('#email-field');

    contactSelect.change(function () {
        loadContact(contactSelect.val())
    });

    loadContact(contactSelect.val());
    
    function loadContact(tripId) {
        console.log(tripId);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "updatemail/getEmail",
            data: {
                trip_id: tripId,
            },
        }).done(function (result) {
            if (result) {
                emailField.val(result['sContactMail']);
            }
        });
    }
});