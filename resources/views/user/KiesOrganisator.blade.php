
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
                <label>Kies uw reis: </label>
                <select name="OrganisatorKiezen" class="select">
                    <?php
                    $aAllTrips = \App\Trip::all()->where('is_active','<>','true');
                    echo $aAllTrips;
                    foreach ($aAllTrips as $oTrip){
                    ?>
                    <option value="<?php echo $oTrip->trip_id ?>"><?php echo $oTrip->name ?></option>
                    <?php } ?>
                </select>

            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection