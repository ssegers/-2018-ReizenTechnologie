@extends('layouts.app')

@section('content')




    <div class="container">
        <div class="form_container">
            <div class="options_container">
                {{Form::open(array('action' => 'UserDataController@showUsersAsMentor', 'method' => 'post'))}}
                <div class="option_cell">
                    {{ Form::checkbox('email', 'email') }}
                    {{ Form::label('email', 'Email', ['class' => 'field']) }}
                </div>
                <div class="option_cell">
                    {{ Form::checkbox('phone', 'phone') }}
                    {{ Form::label('phone', 'Telefoon', ['class' => 'field']) }}
                </div>
                <div class="option_button">
                    <button type="submit" name="button-filter" value="button-filter">Filter lijst</button>
                </div>
                {{ Form::close() }}
            </div>


        </div>
        <div class="table_container">
            @foreach ($aUserData as $oUserData)
                {{ $oUserData->traveller_id }}
            @endforeach

            {{ $aUserData->links() }}
        </div>
    </div>




@endsection
@section('style')
    <style>
        .container {
            display: grid;
            grid-template-columns: 20% auto;
            grid-template-rows: 400px;
            grid-column-gap: 5%;

            background: white;
            padding: 50px;
            width: 1000px;
            margin: 0 auto;


        }
        .form_container{
            background: #E9F3F8;
        }
        .table_container{
            background: #E9F3F8;
        }
        .option_cell{
            display: grid;
            grid-template-columns: 30px auto;
            grid-template-rows: 50px;
        }
        .option_button{
        }
    </style>
@endsection

