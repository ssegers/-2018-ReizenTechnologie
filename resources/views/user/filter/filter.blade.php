@extends('layouts.app')

@section('content')

    {{Form::open(array('action' => 'UserDataController@showUsersAsMentor', 'method' => 'post'))}}
        <ul>
            <li>
                {{ Form::label('email', 'Email', ['class' => 'field']) }}
                {{ Form::checkbox('email', 'email') }}
            </li>
            <li>
                {{ Form::label('phone', 'Telefoon', ['class' => 'field']) }}
                {{ Form::checkbox('phone', 'phone') }}
            </li>
        </ul>
        <button type="submit" name="button-filter" value="button-filter">Filter lijst</button>
    {{ Form::close() }}


    @foreach ($aUserData as $oUserData)
        {{ $oUserData->traveller_id }}
    @endforeach

    {{ $aUserData->links() }}

@endsection
@section('style')
    <style>

    </style>
@endsection

