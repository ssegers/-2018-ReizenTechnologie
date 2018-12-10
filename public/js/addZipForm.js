$(document).ready(function () {
    $('#error').hide();
    $('#add-zip-button').click(function(){
        var zip_code = $('#zip-text').val();
        var city = $('#city-text').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "step-add-zip",
            data: {
                city: city,
                zip_code: zip_code,
            },
            success:function (result) {
                if (result["zipAdded"]==true) {
                    $('#error').hide();
                    $('#dropGemeentes').append(new Option(result["zip_code"]+ " "+result["city"], result["zip_id"], false, false));
                    $('#dropGemeentes').val(result["zip_id"]);
                    $('.filter-option-inner-inner').html(result["zip_code"]+ " "+result["city"]);
                }
                else{
                    $('#error').show();
                    $('#error').html('Ingevulde Postcode is niet geldig');
                }


            },
            error: function(){
                $('#error').html('Ingevulde Postcode is niet geldig');
            }
        })
    });
});