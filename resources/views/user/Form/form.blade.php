@extends('layouts.app')

@section('content')

    <form id="registerForm" action="{{ action('RegisterController@formPost') }}">
        <h1 class="formTitel">Inschrijvings formulier</h1>
        <!-- One "tab" for each step in the form: -->
        <div class="tab">Basisgegevens:
            <p><label class="formLabel">Reis:</label>
                {{ Form::select('dropReis', array('1' => 'USA 2019', '2' => 'Duitsland 2019'), ['id'=>'dropReis','oninput'=>'this.className'])}}</p>
            <p><label class="formLabel">Studentnummer</label>{{ Form::text('txtStudentnummer', '', ['id'=>'txtStudentnummer','oninput'=>'this.className'])}}</p>
            <p><label class="formLabel">Opleiding</label>
                {{ Form::select('dropReis', array('1' => 'ELO-ICT', '2' => 'Docent'), ['id'=>'dropOpleiding','oninput'=>'this.className'])}}</p>
            <p><label class="formLabel">Afstudeerrichting</label>
                {{ Form::select('dropAfstudeerrichtingen', array('1' => 'ELO', '2' => 'ICT', '3' => 'Begeleider'), ['id'=>'dropAfstudeerrichtingen','oninput'=>'this.className'])}}</p>
        </div>

        <div class="tab">Persoonlijke gegevens:
            <p><label class="formLabel">Naam</label>{{ Form::text('txtNaam', '', ['id'=>'txtNaam','oninput'=>'this.className'])}}</p>
            <p><label class="formLabel">Voornaam</label>{{ Form::text('txtVoornaam', '', ['id'=>'txtVoornaam','oninput'=>'this.className'])}}</p>
            <p><label class="formLabel">Geslacht</label>
                <p>{{ Form::radio('gender', 'Man', ['id'=>'radioGeslacht','oninput'=>'this.className'])}}Man
                {{ Form::radio('gender', 'Vrouw', ['id'=>'radioGeslacht','oninput'=>'this.className'])}}Vrouw
                {{ Form::radio('gender', 'Andere', ['id'=>'radioGeslacht','oninput'=>'this.className'])}}Andere
            </p></p>
            <p><label class="formLabel">Nationaliteit</label>{{ Form::text('txtNationaliteit', '', ['id'=>'txtNationaliteit','oninput'=>'this.className'])}}</p>
            <p><label class="formLabel">Geboortedatum</label>{{ Form::date('dateGeboorte', '', ['id'=>'dateGeboorte','oninput'=>'this.className','type'=>'date'])}}</p>
            <p><label class="formLabel">Geboorteplaats</label>{{ Form::text('txtGeboorteplaats', '', ['id'=>'txtGeboorteplaats','oninput'=>'this.className'])}}</p>
            <p><label class="formLabel">Adres</label>{{ Form::text('txtAdres', '', ['id'=>'txtAdres','oninput'=>'this.className'])}}</p>
            <p><label class="formLabel">Land</label>{{ Form::text('txtLand', '', ['id'=>'txtLand','oninput'=>'this.className'])}}</p>
            <p><label class="formLabel">Woonplaats</label>{{ Form::text('dropGemeente', '', ['id'=>'dropGemeente','oninput'=>'this.className'])}}</p>
            <p><label class="formLabel">Bankrekeningnummer (IBAN)</label>{{ Form::text('txtBank', '', ['id'=>'txtBank','oninput'=>'this.className'])}}</p>

        </div>

        <div class="tab">Contact gegevens:
            <p><label class="formLabel">E-mail adres (van de school)</label><input id="txtEmail" oninput="this.className = ''"></p>
            <p><label class="formLabel">GSM-nummer</label>{{ Form::text('txtGsm', '', ['id'=>'txtGsm','oninput'=>'this.className'])}}</p>
            <p><label class="formLabel">Noodnummer 1</label>{{ Form::text('txtNoodnummer1', '', ['id'=>'txtNoodnummer1','oninput'=>'this.className'])}}</p>
            <p><label class="formLabel">Noodnummer 2</label>{{ Form::text('txtNoodnummer2', '', ['id'=>'txtNoodnummer2','oninput'=>'this.className'])}}</p>
        </div>

        <div class="tab">Medische gegevens:
            <p><label class="formLabel">Heeft u een operatie gehad in het afgelopen jaar?</label>
                {{ Form::radio('check', 'yes', ['id'=>'radioMedisch','oninput'=>'this.className'])}}Ja
                {{ Form::radio('check', 'no', ['id'=>'radioMedisch','oninput'=>'this.className'])}}Nee

            </p>
            <p><label class="formLabel">Wat houden de medische aandoeningen in?</label>{{ Form::text('txtMedisch', '', ['id'=>'txtMedisch','oninput'=>'this.className'])}}</p>
        </div>

        <div style="overflow:auto;">
            <div style="float:right;">
                <button class="formButton" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button class="formButton" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
            </div>
        </div>

        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
        </div>

    </form>

    <script src="{{ URL::asset('/js/form.js') }}"></script>


@endsection