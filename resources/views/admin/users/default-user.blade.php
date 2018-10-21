@extends('layouts.admin')

@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="admin-form">
        {{Form::open(array('action' => 'CreateUserController@createUser', 'method' => 'post' ))}}
        {{Form::label('username', 'Gebruikersnaam: ')}}
        {{Form::text('username', '', ['class' => 'form-control', 'placeholder' => $sUserName, 'required'])}}
        {{Form::label('password', 'Paswoord: ')}}
        {{Form::password('password', ['required'])}}
        <div class="actions">
            {{Form::submit('Gebruiker Toevoegen')}}
            <input type="button" onclick="history.go(0)" value="Annuleren"/>
        </div>

    </div>
    {{Form::close()}}
@endsection