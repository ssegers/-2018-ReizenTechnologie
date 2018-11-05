@extends('layouts.admin')

@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <h1>Pas hier het standaardaccount aan:</h1>
    {{Form::open(array('action' => 'AdminUserController@createUser', 'method' => 'post' ))}}
    <div class="form-group">
        {{Form::label('username', 'Gebruikersnaam: ', ['class' => ''])}}


        {{ Form::text('username', null, array("placeholder"=>$sUserName, "class" => "form-control", "required" )) }}
    </div>
    <div class="form-group">
        {{Form::label('password', 'Paswoord: ')}}
        {{Form::password('password', ['required', "class" => "form-control"])}}<br />
        <div class="actions">
            {{Form::submit('Account Aanpassen', ['class' =>'btn btn-success' ])}}
            <input type="button" class="btn btn-danger btn-sm" onclick="history.go(0)" value="Annuleren"/>
        </div>

    </div>
    {{Form::close()}}
@endsection