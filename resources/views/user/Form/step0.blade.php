@extends('layouts.app')

@section('content')

    <div class="container bg-white rounded shadow-sm">
        {{ Form::open(array('action' => 'RegisterController@step0', 'method' => 'post')) }}
        {{ csrf_field() }}

        <h2 class="my-2 pb-2 border-bottom border-dark">Lees aandachtig!</h2>
        <div class="border-bottom pt-2">
            <p>Beste student,</p>

            <p>Met dit inschrijfformulier kan je je inschrijven voor de buitenlandse reis.</p>

            <p>Er worden in dit formulier heel wat gegevens gevraagd, maar deze zijn echt wel noodzakelijk, hetzij voor het reserveren van een hotelkamer, het boeken van een vlucht, het aanvragen van een visum, het afsluiten van een reisverzekering, ...</p>

            <p class="text-danger font-weight-bold">Het is van het grootste belang dat je de gevraagde gegevens correct invult en dat de naam en de adresgegevens exact hetzelfde worden geschreven als op je officiële paspoort.</p>

            <p>Het formulier bestaat uit verschillende deelformulieren. Je kan pas overgaan naar een volgend deelformulier als al de gegevens van het getoonde formulier correct zijn ingevuld. Pas als alle formulieren correct zijn ingevuld wordt de "opslaan" knop actief en kan je het formulier opslaan. Je ontvangt hiervan ook een bevestiging per email.</p>
        </div>


        {{ Form::submit('Volgende',['class' => 'btn btn-primary form-control col-sm-2 mb-4 mt-2 ']) }}
        {{ Form::close() }}
    </div>
    <script src="{{ URL::asset('/js/cascadingDropDownStudyMajors.js') }}"></script>

@endsection