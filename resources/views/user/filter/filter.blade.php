@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="form_container">
            <div class="options_container">
                {{Form::open(array('action' => 'UserDataController@showUsersAsMentor', 'method' => 'post'))}}

                @foreach($aFilterList as $sFilterName => $sFilterText)
                    <div class="option_cell">
                        <label for="{{ $sFilterName }}">
                            {{ $sFilterText }}
                            @if(array_key_exists($sFilterName, $aFiltersChecked))
                                {{ Form::checkbox($sFilterName, null, true) }}
                            @else
                                {{ Form::checkbox($sFilterName, null, false) }}
                            @endif
                        </label>
                    </div>
                @endForeach

                <div class="option_button">
                    <button type="submit" name="button-filter" value="button-filter">Filter lijst</button>
                </div>
            </div>
            <div class="option_button">
                <button type="submit" name="export" value="pdf">Export To PDF</button>
            </div>
            <div class="option_button">
                <button type="submit" name="export" value="exel">Export To Excel</button>
            </div>
            {{ Form::close() }}

        </div>
        <div class="table_container">
            <table class="gegTable">
                <thead>
                <tr>
                    @foreach($aFiltersChecked as $sFilterValue)
                        <th>{{ $sFilterValue }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach($aUserData as $oUserData)
                    <tr>
                        @foreach($aFiltersChecked as $sFilterName => $sFilterText)
                            <td>{{ $oUserData->$sFilterName }}</td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination_container">
                {{ $aUserData->links() }}
            </div>

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
            position: relative;
        }


        .option_cell{
            position: relative;
            display: block;
            padding: 15px;
            border-bottom: 1px solid black;
        }
        .option_cell input {
            position: absolute;
            right: 15px;
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


        .pagination_container{
            line-height: 20px;
            position: absolute;
            bottom:0;
            /* move the element half way across the screen */
            left: 50%;
            /* allow the width to be calculated dynamically */
            width: auto;
            /* then move the element back again using a transform */
            transform: translateX(-50%);
        }
        .pagination_container ul{
            list-style-type: none;
            display: inline-block;
            margin: auto;
            padding-inline-start: 0px;
        }
        .pagination_container li {
            float: left;
            padding-left: 5px;
            padding-right: 5px;
        }
    </style>
@endsection

