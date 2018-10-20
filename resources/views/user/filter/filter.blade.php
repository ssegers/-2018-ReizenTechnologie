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
        <ul class="list-trip">
            @foreach($aActiveTrips as $aTripData)
                <li
                @if($aTripData['oTrip']->trip_id == $oCurrentTrip->trip_id)
                    class="active"
                @endif
                >
                    {{ $aTripData['oTrip']->name }} {{ $aTripData['oTrip']->year }} ({{ $aTripData['iCount'] }})
                </li>
            @endforeach
        </ul>
        <h1 class="page-title">Deelnemers {{ $oCurrentTrip->name }} {{ $oCurrentTrip->year }}</h1>
        <ul class="download-options">
            <li>Download</li>
            <li class="export"><button type="submit" name="export" value="pdf">PDF</button></li>
            <li class="divider">/</li>
            <li class="export"><button type="submit" name="export" value="excel">Excel</button></li>
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