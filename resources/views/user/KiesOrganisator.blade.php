
@extends('layouts.app')

@section('content')
    <div class="text-center">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <br>
                <label>Kies uw reis: </label>
                <select name="ReisKiezen" class="select">
                    <?php
                    $aAllTrips = \App\Trip::all()->where('is_active','<>','true');
                    echo $aAllTrips;
                    foreach ($aAllTrips as $oTrip){
                    ?>
                    <option value="<?php echo $oTrip->trip_id ?>"><?php echo $oTrip->name ?></option>
                <?php } ?>
                    </select>
                <br>
                <label>Kies uw organisator: </label>
                <select name="OrganisatorKiezen" class="select">
                </select>

            </div>
            <div class="col"></div>
        </div>
    </div>
    <script>
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
                        complete: function(){
                            $('#loader').css("visibility", "hidden");
                        }
                    });
                } else {
                    $('select[name="OrganisatorKiezen"]').empty();
                }

            });

        });
    </script>


@endsection