
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

    <script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ URL::asset('/js/dropswitch.js') }}"></script>


@endsection