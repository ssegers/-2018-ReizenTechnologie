$(document).ready(function() {


        // Save the place increment and value of the select
        var trip_id =  $('.travelChanged').val();
        getActiveOrganizers(trip_id);

    // Monitor your selects for change by classname
    $('.travelChanged').on('change', function() {

        // Save the place increment and value of the select
        trip_id = $(this).val();
        $(".organizerTable tbody > tr").remove();
        getActiveOrganizers(trip_id);
    });


    function buildTable(data) {
        for (let i = 0; i < data.length; i++) {
            $(".organizerTable tbody").append('<tr>' +
                '<td>' + data[i].first_name + '</td>' +
                '<td>' + data[i].last_name + '</td>' +
                '<td>' +
                '<a href="linkorganisator/trip_id=' + trip_id + '&traveller_id='+ data[i].traveller_id + '/" id=' + data[i].traveller_id + '>\n' +
                '<i class="fas fa-minus-circle"></i></a></td>' +
                '</tr>');
        }
    }


    function getActiveOrganizers(trip_id) {
        // Send this data to a script somewhere via AJAX
        $.ajax({
            type: "POST",
            url: "linkorganisator/",
            data: {
                trip_id: trip_id,
            }
        })
            .done(function( result ) {
                var data = result['aMentors'];
                console.log(data);
                buildTable(data);
            });
    }
});