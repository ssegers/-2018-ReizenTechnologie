@extends('layouts.app')

@section('content')

    <div class="loader">
    </div>
    <div class="loaderBackground"></div>
    <div class="container">
        <div class="alert alert-success success-mail">
            <strong>Succes!</strong> De emails zijn succesvol verzonden
        </div>
        <div class="alert alert-danger error-mail">
            <strong>Error!</strong> De emails zijn niet verzonden. Probeer opnieuw of check je internetconnectie.
        </div>
        <div class="row"><div class="col-md-6"><h1 class="page-title">Betalingsoverzicht</h1></div><div class="col-md-6"> <button type="button" style="margin-top: 9px;" class="loadButton btn float-right btn-primary">Studenten betalingsstatus mailen</button></div></div>
        <div class="table-wrapper-scroll">
            <table id="paymentStatusTable" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th class="th-sm">Naam</th>
                    <th class="th-sm">Voornaam</th>
                    <th class="th-sm">Studierichting</th>
                    <th class="th-sm">Afstudeerrichting</th>
                    <th class="th-sm">Totaal</th>
                    <th class="th-sm">Reeds betaald</th>
                    <th class="th-sm">Saldo (te betalen)</th>
                    <th class="th-sm">Betaling</th>
                </tr>
                </thead>
                <tbody>
                @foreach($userdata as $oUserData)
                    <tr>
                        <td class="field">{{ $oUserData['last_name'] }}</td>
                        <td class="field">{{ $oUserData['first_name'] }}</td>
                        <td class="field">{{ $oUserData['study_name'] }}</td>
                        <td class="field">{{ $oUserData['major_name'] }}</td>
                        <td class="field">{{ $oUserData['price'] }}</td>
                        <td class="field">{{ $paymentsum[$oUserData['traveller_id']] }}</td>
                        <td class="field">{{ $oUserData['price']-$paymentsum[$oUserData['traveller_id']] }}</td>
                        <td class="field"> <button type="button" class="open btn-primary rounded btn-xs  " data-id="{{$oUserData['traveller_id']}}"data-toggle="modal" data-target="#paymentPopUp">
                                <i class="fas fa-plus-circle "></i>
                            </button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @foreach($userdata as $oUserData)
        <div class="modal" id="paymentPopUp" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Overzicht</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{Form::open(array('action' => 'PaymentsOverviewController@addPayment', 'method' => 'post' ))}}
                        {{Form::hidden('traveller_id',$oUserData['traveller_id'])}}
                        <div class="form-group col">
                            {{Form::label('payment_date', 'Betalingsdatum ', ['class' => ''])}}
                            {{ Form::date('payment_date', null, array("class" => "form-control", "required", "oninvalid" => "this.setCustomValidity('Deze datum is ongeldig')", "oninput" => "this.setCustomValidity('')")) }}
                        </div>
                        <div class="form-group col">
                            {{Form::label('amount', 'Betaling: ', ['class' => ''])}}
                            {{ Form::number('amount', null, array("class" => "form-control", "required", "min" => "0", "oninvalid" => "this.setCustomValidity('Deze betaling is ongeldig')", "oninput" => "this.setCustomValidity('')" )) }}
                        </div>
                    </div>

                    <div class="modal-footer">
                        {{Form::submit('Betaling toevoegen', ['class' =>'btn btn-primary' ])}}
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        @endforeach
    </div>


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
    <style src="{{ URL::asset('/css/payment.scss') }}"></style>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>


    <script src="{{ URL::asset('/js/payment.js') }}"></script>
    <script src="{{ URL::asset('/js/PaymentMailStatus.js') }}"></script>
@endsection