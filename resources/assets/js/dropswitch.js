$(document).ready(function() {
console.log('teetst');
    $('select[name="ReisKiezen"]').on('change', function(){
        var tripId = $(this).val();
        console.log(tripId);
        if(tripId) {
            $.ajax({
                url: '/admin/get/organisators/'+tripId,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    $('#loader').css("visibility", "visible");
                },
                success:function(data) {

                    $('select[name="OrganisatorKiezen"]').empty();

                    $.each(data, function(fistname,lastname, id){

                        $('select[name="OrganisatorKiezen"]').append('<option value="'+ fistname+' '+lastname +'">' + id + '</option>');

                    });
                },

                error: function(req, err){ console.log('my message' + err);
                },

                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[name="OrganisatorKiezen"]').append('<option value="Geen waarde gevonden">id</option>');
        }

    });

});