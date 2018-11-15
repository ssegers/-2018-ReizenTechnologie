<!--
 * Created by PhpStorm.
 * User: kaana
 * Date: 15/11/2018
 * Time: 9:36
 */-->
@extends('layouts.app')

@section('content')
    <div>
        <h1>Contactpagina:</h1>
        <form>
            <select class="form-control" name="reis" id="reis">
                @foreach($oActiveTrips as $oActiveTrip)
                    <option value="{{$oActiveTrip->trip_id}}">{{$oActiveTrip->name}}</option>
                @endforeach
            </select><br>
            <label for="onderwerp">Onderwerp :</label><br>
            <input class="form-control" type="text" id="onderwerp" name="onderwerp"><br>
            <label for="bericht">Bericht: </label><br>
            <textarea rows="5" class="form-control" name="bericht" id="bericht"></textarea><br>
            <input class="form-control" type="submit" value="Verzend">
        </form>
    </div>
@endsection