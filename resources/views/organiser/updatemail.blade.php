@extends('layouts.app')

@section('content')
    <div>
        <h1>Update Mail:</h1>
        <br>
        {{ Form::open(array('action' => 'UpdateMailController@createMail', 'method' =>'post')) }}

        <label for="onderwerp">Onderwerp :</label><br>
        {{Form::text('onderwerp','',array("class" => "form-control", "required" ))}}
        <br>
        <label for="ontvangers">Ontvangers:</label><br>
        {{Form::text('ontvangers','',array("class" => "form-control", "required" ))}}
        <br>
        <label for="bericht">Bericht: </label><br>
        {{ Form::textarea('bericht','',array("class" => "form-control", "required" )) }}<br>
        {{ Form::submit('Verzend',array("class" => "btn")) }}
        {{ Form::close() }}
    </div>

@endsection