@extends('layouts.app')

@section('styles')
    <style>body{height:100vh;overflow:hidden;}</style>
@endsection

@section('content')

    {{Form::open(array('url' => "user/trip/$oCurrentTrip->trip_id", 'method' => 'post'))}}

    <div id="menu-left">
        <div class="container-fluid d-flex h-100 flex-column">
            <div class="row flex-shrink-0">
                <div class="col">
                    <button type="submit" name="button-filter" value="button-filter" class="btn btn-primary">Selectie toepassen</button>
                </div>
            </div>
            <div class="row flex-fill d-flex overflow-auto">
                <div class="col">
                    @foreach($aFilterList as $sFilterName => $sFilterText)
                        <div class="form-group">
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
                </div>
            </div>
        </div>
    </div>

    <div id="content-right">
        <div class="container-fluid d-flex h-100 flex-column">
            <div class="row flex-shrink-0">
                @foreach($aActiveTrips as $aTripData)

                    @if(array_has($aAuthenticatedTripId, $aTripData['oTrip']->trip_id))
                        <a href="/user/trip/{{ $aTripData['oTrip']->trip_id }}" class="btn btn-success badge-custom">
                            {{ $aTripData['oTrip']->name }} {{ $aTripData['oTrip']->year }}
                            <span class="badge badge-light">{{ $aTripData['iCount'] }}</span>
                        </a>
                    @else
                        <div class="btn btn-danger badge-custom">
                            {{ $aTripData['oTrip']->name }} {{ $aTripData['oTrip']->year }}
                            <span class="badge badge-light">{{ $aTripData['iCount'] }}</span>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="row flex-shrink-0">
                <div class="col-lg">
                    <h1>Deelnemers {{ $oCurrentTrip->name }} {{ $oCurrentTrip->year }}</h1>
                </div>
                <div class="col-lg-3 text-right">
                    <button class="btn btn-primary" type="submit" name="export" value="pdf">PDF</button>
                    <button class="btn btn-primary" type="submit" name="export" value="excel">Excel</button>
                </div>
            </div>

            <div class="row flex-fill d-flex overflow-auto">
                <div class="col">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            @foreach($aFiltersChecked as $sFilterValue)
                                <th>{{ $sFilterValue }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($aUserData as $oUserData)
                            <tr class="cursor-pointer" onclick="displayUser('<?php echo $oUserData->username ?>')">
                                @foreach($aFiltersChecked as $sFilterName => $sFilterText)
                                    <td class="field {{ $sFilterName }}">{{ $oUserData->$sFilterName }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row flex-shrink-0">
                <div class="col text-left">
                    {{ $aUserData->appends(request()->input())->links() }}
                </div>
                <div class="col text-right">
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
        </div>
    </div>

    {{ Form::close() }}

    <script type="text/javascript">
        function displayUser(userName) {
            window.location.href = '<?php echo url('/') ?>/userinfo/' + userName;
        }
    </script>
@endsection