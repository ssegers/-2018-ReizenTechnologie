@extends('layouts.app')

@section('content')

    <h1 class="page-title">Betalingsoverzicht</h1>
    {{Form::open(array('action'=>'PaymentOverviewController@step1', 'method' => 'post'))}}
    <div class="table-wrapper-scroll">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Naam</th>
                <th>Voornaam</th>
                <th>Studierichting</th>
                <th>Afstudeerrichting</th>
                <th>Betaald</th>
                <th>Saldo</th>
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

@endsection