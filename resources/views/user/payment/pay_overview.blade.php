@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="loader">
        </div>
        <div class="row"><h1 class="page-title">Betalingsoverzicht</h1> <button type="button" class="btn float-right btn-primary" onclick="addActiveOrganizer()">Studenten herhalingsmail verzenden</button></div>

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