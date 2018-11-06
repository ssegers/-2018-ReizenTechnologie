$(document).ready(function() {


    // Save the place increment and value of the select
    var trip_id =  $('.ReisKiezen').val();
    getTravellers();

    // Monitor your selects for change by classname
    $('.travelChanged').on('change', function() {

        // Save the place increment and value of the select
        var trip_id = $(this).val();
        $(".organizerTable tbody > tr").remove();
        getTravellers(trip_id);
    });


    function buildTable(data) {
        for (let i = 0; i < data.length; i++) {
            $(".organizerTable tbody").append('<tr>' +
                '<td>' + data[i].first_name + '</td>' +
                '<td>' + data[i].last_name + '</td>' +
                '<td>' +
                '<a href="linkorganisator/' + data[i].traveller_id + '/" id=' + data[i].traveller_id + '>\n' +
                '<i class="fas fa-minus-circle"></i></a></td>' +
                '</tr>');
        }
    }
    function ChangeDrop(data) {

    }


    function getTravellers(trip_id = 1) {
        // Send this data to a script somewhere via AJAX
        $.ajax({
            type: "GET",
            url: "get/organisators/"+trip_id
        })
            .done(function( result ) {
                var data = result['aTravellers'];
                console.log(data);
                ChangeDrop(data);
            });
    }
});