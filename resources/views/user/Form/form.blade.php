@extends('layouts.app')

@section('content')
    <form id="registerForm" action="{{ action('RegisterController@formPost') }}">
        <h1>Schrijf je hier in:</h1>
        <!-- One "tab" for each step in the form: -->
        <div class="tab">Kies je reis:
            <p><select id="dropReis" name="reizen">
                    <option>USA 2019</option>
                    <option>Duitsland 2019</option>
                </select></p>
            <p><label>Studentnummer</label><input id="txtStudentnummer" oninput="this.className=''"></p>
            <p><label>Opleiding</label><select id="dropOpleiding" name="opleidingen">
                    <option>Elo-ICT</option>
                    <option>Docent</option>
                </select></p>
            <p><label>Afstudeerrichting</label><select id="dropAfstudeerrichting" name="afstudeerrichtingen">
                    <option>Elo</option>
                    <option>ICT</option>
                    <option>Begeleider</option>
                </select></p>
        </div>

        <div class="tab">Persoonlijke gegevens:
            <p><label>Naam</label><input id="txtNaam" oninput="this.className = ''"></p>
            <p><label>Voornaam</label><input id="txtVoornaam" oninput="this.className = ''"></p>
            <p><label>Geslacht</label>
                <input id="radioGeslacht" type="radio" name="gender" value="male" checked> Man<br>
                <input id="radioGeslacht"type="radio" name="gender" value="female"> Vrouw<br>
                <input id="radioGeslacht"type="radio" name="gender" value="other"> Andere</p>
            <p><label>Nationaliteit</label><input id="txtNationaliteit oninput="this.className = ''"></p>
            <p><label>Geboortedatum</label><input id="dateGeboorte" type="date" name="bday" oninput="this.className = ''"></p>
            <p><label>Adres</label><input id="txtAdres" oninput="this.className = ''"></p>
            <p><label>Land</label><input id="txtLand"oninput="this.className = ''"></p>
            <p><label>Woonplaats</label><input id="dropGemeente" oninput="this.className = ''"></p>
            <p><label>Bankrekeningnummer (IBAN)</label><input id="txtBank" oninput="this.className = ''"></p>

        </div>

        <div class="tab">Contact gegevens:
            <p><label>E-mail adres (van de school)</label><input id="txtEmail" oninput="this.className = ''"></p>
            <p><label>GSM-nummer</label><input id="txtGsm" oninput="this.className = ''"></p>
            <p><label>Noodnummer 1</label><input id="txtNoodnummer1" oninput="this.className = ''"></p>
            <p><label>Noodnummer 2</label><input id="txtNoodnummer2" oninput="this.className = ''"></p>
        </div>

        <div class="tab">Medische gegevens:
            <p><label>Heeft u een operatie gehad in het afgelopen jaar?</label>
                <input id="radioMedisch" type="radio" name="check" value="yes" >Ja
                <input id="radioMedisch" type="radio" name="check" value="no" checked>Neen
            </p>
            <p><label>Wat houden de medische aandoeningen in?</label><input id="txtMedisch" oninput="this.className = ''"></p>
        </div>

        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
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
@endsection