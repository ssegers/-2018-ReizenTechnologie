$(document).ready(function() {

    // Save the place increment and value of the select
    var trip_id =  $('.travelChanged').val();
    getActiveOrganizers(trip_id);

    // Monitor your selects for change by classname
    $('.travelChanged').on('change', function() {

        // Save the place increment and value of the select
        trip_id = $(this).val();
        getActiveOrganizers(trip_id);
    });


    function getActiveOrganizers(trip_id) {
        // Send this data to a script somewhere via AJAX
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "linkorganisator/",
            data: {
                trip_id: trip_id,
            }
        })
            .done(function( result ) {
                var data = result['aMentors'];
                buildTable(data);
            });
    }


});

function buildTable(data) {
    $(".organizerTable tbody > tr").remove();

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

function deleteActiveOrganizer(e,traveller_id) {
    var trip_id =  $('.travelChanged').val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
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

function addActiveOrganizer() {
        var checkedVals = $('.organizersCheckbox:checkbox:checked').map(function() {
            return this.value;
        }).get();
    var trip_id =  $('.travelChanged').val();

    // Send this data to a script somewhere via AJAX
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "linkorganisator/add",
        data: {
            trip_id: trip_id,
            traveller_ids: checkedVals,
        }
    })
        .done(function( result ) {
            var data = result['aMentors'];
            buildTable(data);
        });
}
//# sourceMappingURL=activeTripOrganiser.js.map

//# sourceMappingURL=activeTripOrganiser.js.map
