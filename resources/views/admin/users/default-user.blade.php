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
    <h1 class="my-5 text-center">Pas hier het standaardaccount aan:</h1>
    {{Form::open(array('action' => 'AdminUserController@createUser', 'method' => 'post' ))}}
    <div class="form-group">
        {{Form::label('username', 'Gebruikersnaam: ', ['class' => ''])}}


        {{ Form::text('username', null, array("placeholder"=>$sUserName, "class" => "form-control", "required" )) }}
    </div>
    <div class="form-group">
        {{Form::label('password', 'Paswoord: ')}}
        {{Form::password('password', ['required', "class" => "form-control"])}}<br />
        {{Form::label('password', 'Paswoord Bevestigen: ')}}
        {{Form::password('password', ['required', "class" => "form-control"])}}<br />
        <div class="actions float-right">
            {{Form::submit('Account Aanpassen', ['class' =>'btn btn-primary mr-5 p-3' ])}}
            <input type="button" class="btn btn-danger p-3" onclick="history.go(0)" value="Annuleren"/>
        </div>

    </div>
    {{Form::close()}}
@endsection