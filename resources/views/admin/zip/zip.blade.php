@extends('layouts.admin')

@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    @if(session()->has('alert-message'))
        <div class="alert alert-danger">
            {{ session()->get('alert-message') }}
        </div>
    @endif

    <h1 class="my-5 text-center">Voeg hier een nieuwe postcode toe:</h1>
    {{Form::open(array('action' => 'AdminZipController@createZip', 'method' => 'post' ))}}
    <div class="form-group">
        {{Form::label('zip', 'Postcode: ', ['class' => ''])}}
        {{ Form::text('zip', null, array("class" => "form-control", "required")) }}
    </div>
    <div class="actions float-right">
        {{Form::submit('Postcode Toevoegen', ['class' =>'btn btn-primary mr-5 p-3' ])}}
        <input type="button" class="btn btn-danger p-3" onclick="history.go(0)" value="Annuleren"/>
    </div>
    {{Form::close()}}


    @endsection