@extends('layouts.app')

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

    <h1>Verstuur hier een mail naar de deelnemers van een reis:</h1>
    {{ Form::open(array('action' => 'MailController@sendUpdateMail', 'method' =>'post')) }}
        <div class="form-group">
            {{ Form::label('subject', 'Onderwerp') }}
            {{ Form::text('subject', '', ['class' => 'form-control', 'required']) }}
        </div>  <div class="form-group">
            {{ Form::label('trip', 'Reis') }}
            {{ Form::select('trip',$aTrips,'' ,array('class' => 'form-control', 'required'))}}
        </div>
        <div class="form-group">
            {{ Form::label('message', 'Bericht') }}
            {{ Form::textArea('message', '', ['class' => 'form-control', 'required']) }}
        </div>
        {{ Form::submit('Verzend',array("class" => "btn btn-primary")) }}
    <input type="button" class="btn btn-danger" onclick="history.go(0)" value="Annuleren"/>
    {{ Form::close() }}
@endsection