@extends('layouts.app')

@section('content')
    <div class="filter_container">
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

                <div class="filter_button">
                    <button type="submit" name="button-filter" value="button-filter">Filter lijst</button>
                </div>
            </div>
            <div class="export_buttons">
                <button type="submit" name="export" value="pdf"><i class="fa fa-file-pdf"></i> </button>
                <button type="submit" name="export" value="exel"><i class="fa fa-file-excel"></i></button>
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