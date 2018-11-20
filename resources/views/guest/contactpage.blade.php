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
        <br>
        {{ Form::open(array('url' => 'user/contact', 'method' =>'post')) }}

        <?php use App\Trip;?>
        <?php $oActiveTrips = Trip::where('is_active',true)->where('contact_mail', '!=' , null)->pluck('name','trip_id')?>

        <label for="reis">Reis: </label><br>
        {!! Form::select('reis', $oActiveTrips, null,array("class" => "form-control")) !!}
            <br>
            <label for="email">E-mail :</label><br>
            {{Form::email('email','',array("class" => "form-control", "required" ))}}
            <br>
            <label for="onderwerp">Onderwerp :</label><br>
            {{Form::text('onderwerp','',array("class" => "form-control", "required" ))}}
            <br>
            <label for="bericht">Bericht: </label><br>
            {{ Form::textarea('bericht','',array("class" => "form-control", "required" )) }}<br>
            {{ Form::submit('Verzend',array("class" => "btn")) }}
        {{ Form::close() }}
    </div>
@endsection