@extends('layouts.app')

@section('content')
    <div class="menu-left">
        {{Form::open(array('url' => "user/$sUserName/trip/travellers", 'method' => 'post'))}}
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
            <li class="export"><button type="submit" name="export" value="pdf">Download PDF<i class="fas fa-2x fa-file-pdf"></i></button></li>
            <li class="export"><button type="submit" name="export" value="excel">Download Excel<i class="fas fa-2x fa-file-excel"></i></button></li>
            <li class="apply"><button type="submit" name="button-filter" value="button-filter">Filter lijst</button></li>
        </ul>
        {{ Form::close() }}
    </div>
    <div class="content-right">
        <table>
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
        {{ $aUserData->appends($aFiltersChecked)->links() }}
    </div>
@endsection