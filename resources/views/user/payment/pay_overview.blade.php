@extends('layouts.app')

@section('content')

    <div class="container">
{{----}}
        <h1 class="page-title">Betalingsoverzicht</h1>
{{----}}
        <div class="table-wrapper-scroll">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Naam</th>
                    <th>Voornaam</th>
                    <th>Studierichting</th>
                    <th>Afstudeerrichting</th>
                    <th>Totaal</th>
                    <th>Betaald</th>
                    <th>Saldo</th>
                    <th>Betaling</th>
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
                        <td class="field">{{ $oUserData['amount'] }}</td>
                        <td class="field">{{ $oUserData['price']-$oUserData['amount'] }}</td>
                        <td class="field"> <button type="button" class="open btn-primary rounded btn-xs  " data-id="{{$oUserData['traveller_id']}}"data-toggle="modal" data-target="#paymentPopUp">
                                <i class="fas fa-plus-circle "></i>
                            </button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- MODAL POPUP -->
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
                        {{Form::hidden('id', '', ['id' => 'traveller_id'])}}
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
    </div>
@endsection