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
                '<button onclick="deleteActiveOrganizer(this,' + data[i].traveller_id + ')">' +
                '<i class="fas fa-minus-circle"></i></button>' +
                '</td>' +
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

function deleteActiveOrganizer(e,traveller_id) {
    var trip_id =  $('.travelChanged').val();
    $.ajax({
        type: "DELETE",
        url: "linkorganisator/delete",
        data: {
            trip_id: trip_id,
            traveller_id: traveller_id,
        },
        success: function(msg){
            e.parentElement.parentElement.remove();
        }
    });
}
//# sourceMappingURL=activeTripOrganiser.js.map
