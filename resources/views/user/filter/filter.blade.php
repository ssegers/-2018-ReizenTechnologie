@extends('layouts.app')

@section('content')
    <style>
        /*#app {*/
            /*padding-top: 66px;*/
        /*}*/
        #trips {
            height: 60px;
        }
        #trips .badge {
            margin: 1em 0.5em;
            line-height: 2em;
        }
        body {
            height: 100vh;
            overflow: hidden;
        }
        #menu-left {
            width: 250px;
            height: calc(100vh - 66px);
            display: inline-block;
            padding: 0;
            background-color: white;
        }
        #content-right {
            width: calc(100% - 250px);
            height: calc(100vh - 66px);
            float: right;
        }
        .menu-header {
            height: 70px;
            padding: 1em 1em;
            border-bottom: 1px solid black;
        }
        .menu-header button {
            width: 100%;
            height: 100%;
        }
        /*.menu-header button:hover {*/
            /*background-color: #E00049;*/
            /*color: white;*/
        /*}*/
        .menu-container {
            height: calc(100% - 70px);
            overflow-y: auto;
        }
        .menu-container ul {
            list-style: none;
            margin: 0;
            padding: 0 1em;
        }
        .menu-container li {
            width: 100%;
            display: block;
            position: relative;
            padding: calc(0.5em + 5px) 1em 0.5em;
            border-top: 1px solid black;
        }
        .menu-container li:first-child {
            border: none;
        }
        .menu-container li input {
            position: absolute;
            right: 1em;
            top: calc(50% - 5px);
        }
        /*.filter-footer {*/
            /*position: absolute;*/
            /*bottom: 0;*/
            /*display: block;*/
            /*width: calc(100% - 250px - 2em);*/
            /*height: 3em;*/
        /*}*/
        .overflow-auto {
            overflow: auto;
        }
        .row {
        }
    </style>

    {{Form::open(array('url' => "user/$sUserName/trip/travellers", 'method' => 'post'))}}

    <div id="menu-left">
        <div class="menu-header">
            <button type="submit" name="button-filter" value="button-filter" class="btn btn-primary">Selectie toepassen</button>
        </div>
        <div class="menu-container">
            <ul>
                @foreach($aFilterList as $sFilterName => $sFilterText)
                    <li>
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
        </div>
    </div>

    <div id="content-right">
        <div class="container-fluid d-flex h-100 flex-column">
            <div class="row flex-shrink-0">
                @foreach($aActiveTrips as $aTripData)
                    <a href="#" class="btn btn-primary badge-custom">
                        {{ $aTripData['oTrip']->name }} {{ $aTripData['oTrip']->year }}
                        <span class="badge badge-light">{{ $aTripData['iCount'] }}</span>
                    </a>
                @endforeach
            </div>

            <div class="row flex-shrink-0">
                <div class="col-lg">
                    <h1>Deelnemers {{ $oCurrentTrip->name }} {{ $oCurrentTrip->year }}</h1>
                </div>
                <div class="col-lg-3">
                    <button class="btn btn-primary" type="submit" name="export" value="pdf">PDF</button>
                    <button class="btn btn-primary" type="submit" name="export" value="excel">Excel</button>
                </div>
                <style>
                    .badge-custom {
                        margin: 1em .5em;
                    }
                </style>
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
                <div class="col">
                    {{ $aUserData->appends(request()->input())->links() }}
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