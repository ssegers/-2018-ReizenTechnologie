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
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Naam</th>
                    <th>Voornaam</th>
                    <th>Studierichting</th>
                    <th>Afstudeerrichting</th>
                    <th>Betaald</th>
                    <th>Saldo</th>
                    <th>Betaling</th>
                </tr>
                </thead>
                <tbody>
                @foreach($userdata as $oUserData)
                    <tr>
                        <td class="field">{{ $userdata['last_name'] }}</td>
                        <td class="field">{{ $userdata['first_name'] }}</td>
                        <td class="field">{{ $userdata['study_name'] }}</td>
                        <td class="field">{{ $userdata['major_name'] }}</td>
                        <td class="field">{{ $userdata['amount'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="{{ URL::asset('/js/PaymentMailStatus.js') }}"></script>
@endsection