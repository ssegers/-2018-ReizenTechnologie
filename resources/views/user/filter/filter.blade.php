@extends('layouts.app')

@section('content')

@endsection

{{--@section('style')--}}
    {{--<style>--}}

        {{--.search input{--}}
            {{--width: 300px;--}}
            {{--height: 50px;--}}
            {{--border: transparent;--}}
            {{--border-right: none;--}}
            {{--outline: none;--}}
            {{--padding-left: 5px;--}}
        {{--}--}}
        {{--.gegTable,.gegTable th,.gegTable td {--}}
            {{--border: 1px solid darkgray;--}}
            {{--border-collapse: collapse;--}}
        {{--}--}}
        {{--.gegTable th{--}}
            {{--text-align: center;--}}
            {{--background-color: #e00049;--}}
            {{--color: #E9F3F8;--}}
        {{--}--}}
        {{--.gegTable th{--}}
            {{--height: 50px;--}}
            {{--width: 350px;--}}
        {{--}--}}
        {{--.gegTable td{--}}
            {{--padding: 15px;--}}
            {{--text-align: right;--}}
        {{--}--}}
        {{--.gegTable{--}}
            {{--margin-bottom: 100px;--}}
        {{--}--}}

        {{--.filterTable,.filterTable td{--}}
            {{--border-bottom: 1px solid darkgray;--}}
            {{--border-top: 1px solid darkgray;--}}
            {{--border-left: 0px;--}}
            {{--border-right: 0px;--}}
            {{--border-collapse: collapse;--}}
        {{--}--}}

        {{--.filterTable td{--}}
            {{--padding: 20px 0px 15px 15px;--}}
            {{--text-align: left;--}}
        {{--}--}}
        {{--.filterTable td:last-child{--}}
            {{--padding: 15px;--}}
        {{--}--}}

        {{--.filterTable tr:last-child td{--}}
            {{--text-align: center;--}}
            {{--padding: 10px 0px 0px;--}}
        {{--}--}}


        {{--.filterTable{--}}
            {{--margin-right: 50px;--}}
            {{--margin-bottom: 100px;--}}
        {{--}--}}
        {{--.button{--}}
            {{--width: 100%;--}}
            {{--height: 100%;--}}
            {{--background-color: #003469;--}}
            {{--border: none;--}}
            {{--color: white;--}}
            {{--padding: 20px;--}}
        {{--}--}}

        {{--table{--}}
            {{--margin-top: 50px;--}}
            {{--display: inline-block;--}}
            {{--float: left;--}}
            {{--max-width: 800px;--}}
            {{--text-align: center;--}}
        {{--}--}}
        {{--.field{--}}
            {{--width: 180px;--}}

        {{--}--}}

    {{--</style>--}}
{{--@endsection--}}
{{--@section('content')--}}
    {{--<div class="container">--}}

        {{--<table class="filterTable">--}}
            {{--{{Form::open(array('action' => 'FilterController@getFilteredTraveller', 'method' => 'post'))}}--}}
            {{--<tr>--}}
                {{--<td>{{ Form::label('lastname', 'Naam', ['class' => 'field']) }}</td>--}}
                {{--<td>{{Form::checkbox('lastname', 'lastname')}}</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td>{{ Form::label('firstname', 'Voornaam', ['class' => 'field']) }}</td>--}}
                {{--<td>{{Form::checkbox('firstname', 'firstname')}}</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td>{{ Form::label('email', 'Email', ['class' => 'field']) }}</td>--}}
                {{--<td>{{Form::checkbox('email', 'email')}}</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td>{{ Form::label('phone', 'Telefoon', ['class' => 'field']) }}</td>--}}
                {{--<td>{{Form::checkbox('phone', 'phone')}}</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td>{{ Form::label('trip_name', 'Reis', ['class' => 'field']) }}</td>--}}
                {{--<td>{{Form::checkbox('trip_name', 'trip_name')}}</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td>{{ Form::label('major_name', 'Klas', ['class' => 'field']) }}</td>--}}
                {{--<td>{{Form::checkbox('major_name', 'major_name')}}</td>--}}
            {{--</tr>--}}
            {{--<tr>--}}
                {{--<td colspan="2">--}}
                    {{--{{Form::submit('Toon Lijst',['class'=>'button'])}}--}}
                {{--</td>--}}
            {{--</tr>--}}
            {{--{{ Form::close() }}--}}
        {{--</table>--}}

        {{----}}
            {{--@php--}}
                {{--var_dump($tripid);--}}
            {{--@endphp--}}
        {{----}}

        {{--<table class="gegTable">--}}
            {{--<tr>--}}
                {{--@foreach($afilters as $ofilters)--}}

                    {{--@php--}}
                        {{--if($ofilters=='firstname')--}}
                            {{--{--}}
                            {{--$ofilters='Voornaam';--}}
                            {{--}--}}
                        {{--if($ofilters=='lastname')--}}
                            {{--{--}}
                            {{--$ofilters='Naam';--}}
                            {{--}--}}

                        {{--if($ofilters=='email')--}}
                            {{--{--}}
                            {{--$ofilters='Email';--}}
                            {{--}--}}
                        {{--if($ofilters=='phone')--}}
                            {{--{--}}
                            {{--$ofilters='Telefoon';--}}
                            {{--}--}}
                        {{--if($ofilters=='trip_name')--}}
                            {{--{--}}
                            {{--$ofilters='Reis';--}}
                            {{--}--}}
                        {{--if($ofilters=='major_name')--}}
                            {{--{--}}
                            {{--$ofilters='Klas';--}}
                            {{--}--}}
                    {{--@endphp--}}

                    {{--<th>{{$ofilters}}</th>--}}
                {{--@endforeach--}}
            {{--</tr>--}}
            {{--@foreach($afilteredUserList as $ofiltereduserlist => $data)--}}
                {{--<tr>--}}
                    {{--@foreach($afilters as $ofilters=>$filter)--}}
                        {{--<td>--}}
                            {{--{{$data[$filter]}}--}}
                        {{--</td>--}}
                    {{--@endforeach--}}
                {{--</tr>--}}
            {{--@endforeach--}}

        {{--</table>--}}
    {{--</div>--}}

{{--@endsection--}}