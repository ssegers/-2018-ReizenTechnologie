
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
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>

    <script>
        $(document).ready(function() {
            console.log('test');
            $('select[name="ReisKiezen"]').on('change', function(){
                var tripId = $(this).val();
                console.log(tripId);
                if(tripId) {
                    jQuery.ajax({
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