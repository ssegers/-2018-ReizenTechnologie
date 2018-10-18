@extends('layouts.app')

@section('content')

    <form id="registerForm" action="{{ action('RegisterController@formPost') }}">
        <h1 class="formTitel">Schrijf je hier in:</h1>
        <!-- One "tab" for each step in the form: -->
        <div class="tab">Basisgegevens:
            <p><label class="formLabel">Reis:</label><select id="dropReis" name="reizen">
                    <option>USA 2019</option>
                    <option>Duitsland 2019</option>
                </select></p>
            <p><label class="formLabel">Studentnummer</label><input id="txtStudentnummer" oninput="this.className=''"></p>
            <p><label class="formLabel">Opleiding</label><select id="dropOpleiding" name="opleidingen">
                    <option>Elo-ICT</option>
                    <option>Docent</option>
                </select></p>
            <p><label class="formLabel">Afstudeerrichting</label><select id="dropAfstudeerrichting" name="afstudeerrichtingen">
                    <option>Elo</option>
                    <option>ICT</option>
                    <option>Begeleider</option>
                </select></p>
        </div>

        <div class="tab">Persoonlijke gegevens:
            <p><label class="formLabel">Naam</label><input id="txtNaam" oninput="this.className = ''"></p>
            <p><label class="formLabel">Voornaam</label><input id="txtVoornaam" oninput="this.className = ''"></p>
            <p><label class="formLabel">Geslacht</label>
                <input id="radioGeslacht" type="radio" name="gender" value="male" checked>Man
                <input id="radioGeslacht"type="radio" name="gender" value="female"> Vrouw
                <input id="radioGeslacht"type="radio" name="gender" value="other"> Andere</p>
            <p><label class="formLabel">Nationaliteit</label><input id="txtNationaliteit oninput="this.className = ''"></p>
            <p><label class="formLabel">Geboortedatum</label><input id="dateGeboorte" type="date" name="bday" oninput="this.className = ''"></p>
            <p><label class="formLabel">Geboorteplaats</label><input id="txtGeboorteplaats oninput="this.className = ''"></p>
            <p><label class="formLabel">Adres</label><input id="txtAdres" oninput="this.className = ''"></p>
            <p><label class="formLabel">Land</label><input id="txtLand"oninput="this.className = ''"></p>
            <p><label class="formLabel">Woonplaats</label><input id="dropGemeente" oninput="this.className = ''"></p>
            <p><label class="formLabel">Bankrekeningnummer (IBAN)</label><input id="txtBank" oninput="this.className = ''"></p>

        </div>

        <div class="tab">Contact gegevens:
            <p><label class="formLabel">E-mail adres (van de school)</label><input id="txtEmail" oninput="this.className = ''"></p>
            <p><label class="formLabel">GSM-nummer</label><input id="txtGsm" oninput="this.className = ''"></p>
            <p><label class="formLabel">Noodnummer 1</label><input id="txtNoodnummer1" oninput="this.className = ''"></p>
            <p><label class="formLabel">Noodnummer 2</label><input id="txtNoodnummer2" oninput="this.className = ''"></p>
        </div>

        <div class="tab">Medische gegevens:
            <p><label class="formLabel">Heeft u een operatie gehad in het afgelopen jaar?</label>
                <input id="radioMedisch" type="radio" name="check" value="yes" >Ja
                <input id="radioMedisch" type="radio" name="check" value="no" checked>Neen
            </p>
            <p><label class="formLabel">Wat houden de medische aandoeningen in?</label><input id="txtMedisch" oninput="this.className = ''"></p>
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