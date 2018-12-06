<!--
 * Created by PhpStorm.
 * User: kaana
 * Date: 15/11/2018
 * Time: 9:36
 */-->
@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1>Contactpagina:</h1>
        <br>
        {{ Form::open(array('url' => 'user/contact', 'method' =>'post')) }}

        <?php use App\Trip;?>
        <?php $oActiveTrips = Trip::where('is_active',true)->where('contact_mail', '!=' , null)->pluck('name','trip_id')?>

            <div class="form-group">
        <label for="reis">Reis: </label><br>
        {!! Form::select('reis', $oActiveTrips, null,array("class" => "form-control")) !!}
            </div>
            <div class="form-group">
            <label for="email">Jouw E-mailadres :</label><br>
            {{Form::email('email','',array("class" => "form-control", "required" ))}}
            </div>
            <div class="form-group">
            <label for="onderwerp">Onderwerp :</label><br>
            {{Form::text('onderwerp','',array("class" => "form-control", "required" ))}}
            </div>
            <div class="form-group">
            <label for="bericht">Bericht: </label><br>
            {{ Form::textarea('bericht','',array("class" => "form-control", "required" )) }}<br>
            </div>
            {{ Form::submit('Verzend',array("class" => "btn btn-primary")) }}
            <input type="button" class="btn btn-danger" onclick="history.go(0)" value="Annuleren"/>
            {{ Form::close() }}
        <br>
    </div>
@endsection