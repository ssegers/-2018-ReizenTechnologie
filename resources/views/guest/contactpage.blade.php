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
        {{ Form::open(array('url' => 'user/contact', 'method' =>'post')) }}

        <?php use App\Trip;?>
        <?php $oActiveTrips = Trip::where('is_active',true)->where('contact_mail', '!=' , null)->pluck('name','trip_id')?>


        {!! Form::select('reis', $oActiveTrips, null) !!}

            <br>
            <label for="onderwerp">Onderwerp :</label><br>
            {{Form::text('onderwerp')}}
            <label for="bericht">Bericht: </label><br>
            {{ Form::textarea('bericht') }}
            {{ Form::submit('Click Me!') }}
        {{ Form::close() }}
    </div>
@endsection