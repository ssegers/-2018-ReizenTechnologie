@extends('layouts.app')

@section('content')
    {{Form::open(array('url' => "user/$sUserName/trip/travellers", 'method' => 'post'))}}
    <div class="menu-left">
        <span class="filter-title">Selecteer gegevens</span>
        <ul class="filters">
            @foreach($aFilterList as $sFilterName => $sFilterText)
                <li class="filter-option">
                    <label for="{{ $sFilterName }}">
                        {{ $sFilterText }}
                        @if(array_key_exists($sFilterName, $aFiltersChecked))
                            {{ Form::checkbox($sFilterName, null, true) }}
                        @else
                            {{ Form::checkbox($sFilterName, null, false) }}
                        @endif
                    </label>
                </li>
            @endForeach
        </ul>
        <ul class="filter-buttons">
            <li class="apply"><button type="submit" name="button-filter" value="button-filter">Pas Gegevens Toe</button></li>
        </ul>
    </div>
    <div class="content-right">
        <h1>Deelnemers {{ $oTrip->name }} {{ $oTrip->year }}</h1>
        <ul class="download-options">
            <li class="export"><button type="submit" name="export" value="pdf">Download PDF<i class="fas fa-2x fa-file-pdf"></i></button></li>
            <li class="export"><button type="submit" name="export" value="excel">Download Excel<i class="fas fa-2x fa-file-excel"></i></button></li>
        </ul>
        <div class="table-container">
            <table class="filter-table">
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
                            <td class="field {{ $sFilterName }}">{{ $oUserData->$sFilterName }}</td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $aUserData->appends($aFiltersChecked)->links() }}
    </div>
    {{ Form::close() }}
@endsection