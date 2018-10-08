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
                <div class="option_cell">
                    {{ Form::checkbox('phone', 'phone') }}
                    {{ Form::label('phone', 'Telefoon', ['class' => 'field']) }}
                </div>
                <div class="option_cell">
                    {{ Form::checkbox('phone', 'phone') }}
                    {{ Form::label('phone', 'Telefoon', ['class' => 'field']) }}
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
            <div class="option_button">
                <button type="submit" name="Export To PDF" value="button-ToPDF">Export To PDF</button>
            </div>
            <div class="option_button">
                <button type="submit" name="Export To Excel" value="button-ToExcel">Export To Excel</button>
            </div>

        </div>
        <div class="table_container">
            <table class="gegTable">
                <tr>
                    <th>Voornaam</th>
                    <th>Naam</th>
                    <th>Email</th>
                    <th>Telefoon</th>
                    <th>Reis</th>
                    <th>Klas</th>
                </tr>


                <tr>
                <tr>
                    <td>test</td>
                    <td>test</td>
                    <td>test</td>
                    <td>test</td>
                    <td>test</td>
                    <td>test</td>
                </tr>
                <tr>
                    <td>test</td>
                    <td>test</td>
                    <td>test</td>
                    <td>test</td>
                    <td>test</td>
                    <td>test</td>
                </tr>
                <tr>
                    <td>test</td>
                    <td>test</td>
                    <td>test</td>
                    <td>test</td>
                    <td>test</td>
                    <td>test</td>
                </tr>
                <tr>
                    <td>test</td>
                    <td>test</td>
                    <td>test</td>
                    <td>test</td>
                    <td>test</td>
                    <td>test</td>
                </tr>
                </tr>
            </table>

            <div class="pagination">
                {{ $aUserData->links() }}
            </div>


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

        </div>
    </div>




@endsection
@section('style')
    <link src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
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

        .gegTable,.gegTable th,.gegTable td {
            border: 1px solid darkgray;
            border-collapse: collapse;
        }
        .gegTable th{
            text-align: center;
            background-color: #e00049;
            color: #E9F3F8;
        }
        .gegTable th{
            height: 50px;
            width: 350px;
        }
        .gegTable td{
            padding: 15px;
            text-align: right;
        }
        .gegTable{
            margin-bottom: 100px;
        }
        .pagination{
            text-align: center;
        }
        .pagination ul{
            list-style-type: none;
            display: inline-block;
            margin: auto;
        }
        .pagination li {
            float: left;
            padding-left: 5px;
            padding-right: 5px;
        }
    </style>
@endsection

