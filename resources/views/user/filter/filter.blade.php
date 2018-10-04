@extends('layouts.app')

@section('content')

    <table class="filterTable">
        {{Form::open(array('action' => 'UserDataController@showUsersAsMentor', 'method' => 'post'))}}
        {{--<tr>--}}
            {{--<td>{{ Form::label('lastname', 'Naam', ['class' => 'field']) }}</td>--}}
            {{--<td>{{Form::checkbox('lastname', 'lastname', true, ['disabled'])}}</td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
            {{--<td>{{ Form::label('firstname', 'Voornaam', ['class' => 'field']) }}</td>--}}
            {{--<td>{{Form::checkbox('firstname', 'firstname', true, ['disabled'])}}</td>--}}
        {{--</tr>--}}
        <tr>
            <td>{{ Form::label('email', 'Email', ['class' => 'field']) }}</td>
            <td>{{Form::checkbox('email', 'email')}}</td>
        </tr>
        <tr>
            <td>{{ Form::label('phone', 'Telefoon', ['class' => 'field']) }}</td>
            <td>{{Form::checkbox('phone', 'phone')}}</td>
        </tr>

        {{--<tr>--}}
            {{--<td>{{ Form::label('trip_name', 'Reis', ['class' => 'field']) }}</td>--}}
            {{--<td>{{Form::checkbox('trip_name', 'trip_name')}}</td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
            {{--<td>{{ Form::label('major_name', 'Klas', ['class' => 'field']) }}</td>--}}
            {{--<td>{{Form::checkbox('major_name', 'major_name')}}</td>--}}
        {{--</tr>--}}
        <tr>
            <td colspan="2">
                <button type="submit" name="button-filter" value="button-filter">Filter lijst</button>
            </td>
        </tr>
        {{ Form::close() }}
    </table>

    @foreach ($aUserData as $oUserData)
        {{ $oUserData->traveller_id }}
    @endforeach

    {{ $aUserData->links() }}

@endsection
@section('style')
    <style>

    </style>
@endsection

