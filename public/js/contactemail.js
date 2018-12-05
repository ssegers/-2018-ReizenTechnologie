$(document).ready(function () {
    var contactSelect = $('#contactSelect');

    var trips = [];

    loadTrips();

function loadTrips() {


    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "mail/getUpdateForm",
        data: '',
    }).done(function (result) {
        if (result) {
           trips  = result['aTrips'];

            updateContactMail();
        }
    });

    function updateContactMail() {
        contactSelect.empty();

        for (var trip of trips) {
            contactSelect.append($('<option>')
                .attr('value', trip.trip_id)
                .text(trip.contact_mail));
        }

        contactSelect.attr('size', trips.length);

        contactSelect.prop("selectedIndex", -1);
    }
}