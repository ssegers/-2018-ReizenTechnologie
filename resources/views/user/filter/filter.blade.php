@extends('layouts.app')

@section('menu-left')
    {{Form::open(array('url' => "user/$sUserName/trip/travellers", 'method' => 'post'))}}
        <button type="submit" name="button-filter" value="button-filter">Pas gegevens toe</button>
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
@endsection

@section('content')
    <div class="trip-overview">
        <ul class="list-trip">
            <ul>
                @foreach($aActiveTrips as $aTripData)
                    <li @if($aTripData['oTrip']->trip_id == $oCurrentTrip->trip_id) class="active" @endif>{{ $aTripData['oTrip']->name }} {{ $aTripData['oTrip']->year }} ({{ $aTripData['iCount'] }})</li>
                @endforeach
            </ul>
        </ul>
    </div>
        <h1 class="page-title">Deelnemers {{ $oCurrentTrip->name }} {{ $oCurrentTrip->year }}</h1>
        <ul class="download-options">
            <li>Download</li>
            <li class="export"><button type="submit" name="export" value="pdf">PDF</button></li>
            <li class="divider">/</li>
            <li class="export"><button type="submit" name="export" value="excel">Excel</button></li>
        </ul>
        <div class="table-container">
            <div class="table-wrapper-scroll-y">
                <style>
                    .table-wrapper-scroll-y {
                        display: block;
                        max-height: 200px;
                        overflow-y: auto;
                        -ms-overflow-style: -ms-autohiding-scrollbar;
                    }
                </style>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        @foreach($aFiltersChecked as $sFilterValue)
                            <th>{{ $sFilterValue }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($aUserData as $oUserData)
                        <tr onclick="displayUser('<?php echo $oUserData->name ?>')">
                            @foreach($aFiltersChecked as $sFilterName => $sFilterText)
                                <td class="field {{ $sFilterName }}">{{ $oUserData->$sFilterName }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="filter-footer">
            {{ $aUserData->appends(request()->input())->links() }}
            <div class="filter-per-page">
                {{ Form::label('per-page', 'Reizigers per pagina:') }}
                <select name="per-page" onchange="this.form.submit()">
                    @foreach($aPaginate as $iValue => $bActive)
                        @if($bActive)
                            <option selected value="{{ $iValue }}">{{ $iValue }}</option>
                        @else
                            <option value="{{ $iValue }}">{{ $iValue }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    {{ Form::close() }}
    <script type="text/javascript">
        function displayUser(userName) {
            window.location.href = '<?php echo url('/') ?>/userinfo/' + userName;
        }
    </script>
@endsection