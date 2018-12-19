@extends('layouts.app')

@section('content')
    <?php use \App\Http\Controllers\PaymentsOverviewController;?>
    <div class="loader">
    </div>
    <div class="loaderBackground"></div>
    <div class="container">
        <div class="container-fluid d-flex  flex-column">
            <div class="row flex-shrink-0">
                @foreach($aActiveTrips as $aTripData)

                    @if(array_has($aAuthenticatedTripId, $aTripData['oTrip']->trip_id))
                        <a href="/user/payment/trip/{{ $aTripData['oTrip']->trip_id }}" class="btn btn-success badge-custom">
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
                    <h1>Betalingsstatus deelnemers {{ $oCurrentTrip->name }} {{ $oCurrentTrip->year }}</h1>
                </div><div class="col-md-6"> <button type="button" style="margin-top: 9px;" class="loadButton btn float-right btn-primary">Studenten betalingsstatus mailen</button></div></div>
            </div>
        <div class="alert alert-success success-mail">
            <strong>Succes!</strong> De emails zijn succesvol verzonden
        </div>
        <div class="alert alert-danger error-mail">
            <strong>Error!</strong> De emails zijn niet verzonden. Probeer opnieuw of check je internetconnectie.
        </div>
        <div class="table-wrapper-scroll">
            <table id="paymentStatusTable" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th class="th-sm">ID nummer</th>
                    <th class="th-sm">Naam</th>
                    <th class="th-sm">Voornaam</th>
                    <th class="th-sm">Bankrekening</th>
                    <th class="th-sm">Totaal</th>
                    <th class="th-sm">Reeds betaald</th>
                    <th class="th-sm">Saldo (te betalen)</th>
                    <th class="th-sm">Betaling</th>
                </tr>
                </thead>
                <tbody>
                @foreach($userdata as $oUserData)
                    <tr>
                        <td class="field">{{ $oUserData['username'] }}</td>
                        <td class="field">{{ $oUserData['last_name'] }}</td>
                        <td class="field">{{ $oUserData['first_name'] }}</td>
                        <td class="field">{{ $oUserData['iban'] }}</td>
                        <td class="field">{{ $oUserData['price'] }}</td>
                        <td class="field">{{ $oUserData['amount'] }}</td>
                        <td class="field">{{ $oUserData['price']-$oUserData['amount'] }}</td>
                        <td class="field"> <button id="modalButton-{{$oUserData['traveller_id']}}" type="button" class="open btn-primary rounded btn-xs  " data-content="{{$oUserData['username']}}"
                                                   data-id="{{$oUserData['traveller_id']}}"data-toggle="modal" data-target="#paymentPopUp" onclick="loadPaymentData({{$oUserData['traveller_id']}})">

                                <i class="fas fa-plus-circle "></i>
                            </button></td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="modal" id="paymentPopUp" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h6>Overzicht van betalingen</h6>
                        <table id="paymentOverviewTable" class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Datum</th>
                                <th>Bedrag</th>
                                <th>Verwijderen?</th>
                            </tr>
                            </thead>
                            <tbody id="paymentdata">

                            </tbody>
                        </table>
                        {{Form::open(array('action' => 'PaymentsOverviewController@addPayment', 'method' => 'post'))}}
                        {{Form::hidden('traveller_id','', array("id"=>"traveller-id"))}}
                        <div class="form-group col">
                            {{Form::label('payment_date', 'Betalingsdatum ', ['class' => ''])}}
                            {{ Form::date('payment_date', null, array("id"=>"date-text","class" => "form-control", "required", "oninvalid" => "this.setCustomValidity('Deze datum is ongeldig')", "oninput" => "this.setCustomValidity('')")) }}
                        </div>
                        <div class="form-group col">
                            {{Form::label('amount', 'Betaling: ', ['class' => ''])}}
                            {{ Form::number('amount', null, array("id"=>"amount-int","class" => "form-control", "required", "min" => "0", "oninvalid" => "this.setCustomValidity('Deze betaling is ongeldig')", "oninput" => "this.setCustomValidity('')" )) }}
                        </div>
                    </div>

                    <div class="modal-footer">
                        {{Form::submit('Betaling toevoegen', ['class' =>'btn btn-primary' ])}}
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.reload()">Cancel</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>

    </div>


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
    <style src="{{ URL::asset('/css/payment.scss') }}"></style>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>

    <script src="{{URL::asset('/js/AddPayment.js')}}"></script>
    <script src="{{ URL::asset('/js/payment.js') }}"></script>
    <script src="{{ URL::asset('/js/PaymentMailStatus.js') }}"></script>
@endsection