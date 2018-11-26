@extends('layouts.app')

@section('content')
    {{ Form::open(array('action' => 'MailController@sendUpdateMail', 'method' =>'post')) }}
        <div class="form-group">
            {{ Form::label('subject', 'Onderwerp') }}
            {{ Form::text('subject', '', ['class' => 'form-control', 'required']) }}
        </div>
        <div class="form-group">
            {{ Form::label('message', 'Bericht') }}
            {{ Form::textArea('message', '', ['class' => 'form-control', 'required']) }}
        </div>
        {{ Form::submit('Verzend',array("class" => "btn btn-primary")) }}
    {{ Form::close() }}
@endsection