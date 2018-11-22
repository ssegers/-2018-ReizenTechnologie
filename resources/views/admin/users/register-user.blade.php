@extends('layouts.admin')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
    <h1 class="my-5 text-center">Registreer hier het  standaardaccount:</h1>
    <h4>Huidige account: {{$sUserName}}</h4><br />


    {{Form::open(array('action' => 'AdminUserController@createUser', 'method' => 'post' ))}}
    <div class="form-group">
        {{Form::label('username', 'Gebruikersnaam: ', ['class' => ''])}}
        {{ Form::text('username', null, array("class" => "form-control", "required" )) }}

    </div>
    <div class="form-group">
        {{Form::label('password', 'Wachtwoord: ')}}
        {{Form::password('password', ['required', "class" => "form-control"])}}<br />
        {{Form::label('password_confirmation', 'Wachtwoord Bevestigen: ')}}
        {{Form::password('password_confirmation', ['required', "class" => "form-control"])}}<br />
        <div class="actions float-right">
            {{Form::submit('Account Registreren', ['class' =>'btn btn-primary mr-5 p-3' ])}}
            <input type="button" class="btn btn-danger p-3" onclick="history.go(0)" value="Annuleren"/>
        </div>

    </div>
    {{Form::close()}}
@endsection