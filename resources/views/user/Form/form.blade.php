@extends('layouts.app')

@section('content')
    <style>
        /*.tab {*/
            /*display: block;*/
            /*width: 100%;*/
        /*}*/
        /*.tab label {*/
            /*width: 35%;*/
        /*}*/
    </style>
    {{ Form::open(array('action' => 'RegisterController@formPost', 'method' => 'post', 'id' => 'registerForm')) }}
        <h1 class="formTitel">Inschrijvings formulier</h1>
        <h2 id="jsAlert" >Om deze formulier te kunnen gebruiken moet uw javascript aanstaan.</h2>
        <!-- One "tab" for each step in the form: -->
        <div class="tab"><h2 class="tabTitle">Basisgegevens:</h2>
            <p><label class="formLabel">Reis:</label>
                {{ Form::select('dropReis', $aTrips, ['id'=>'dropReis','oninput'=>'this.className'])}}</p>

            <p><label class="formLabel">Studentnummer</label>{{ Form::text('txtStudentnummer', '', ['id'=>'txtStudentnummer','oninput'=>'this.className'])}}</p>
            <p><label class="formLabel">Opleiding</label>
            <span id="opleidingSelect" onclick="checkMajor()">{{ Form::select('dropOpleiding', $aOpleidingen, ['id'=>'dropOpleiding','oninput'=>'this.className'])}}</span></p>
            <p><label class="formLabel">Afstudeerrichting</label>

                {{ Form::select('dropAfstudeerrichtingen', $aMajors, ['id'=>'dropAfstudeerrichtingen','oninput'=>'this.className'])}}</p>
        </div>

    <div class="tab"><h2 class="tabTitle">Persoonlijke gegevens:</h2>
            <p><label class="formLabel">Naam</label>{{ Form::text('txtNaam', '', ['id'=>'txtNaam','oninput'=>'this.className'])}}</p>
            <p><label class="formLabel">Voornaam</label>{{ Form::text('txtVoornaam', '', ['id'=>'txtVoornaam','oninput'=>'this.className'])}}</p>
            <p><label class="formLabel">Geslacht</label>
                {{ Form::radio('gender', 'Man', ['id'=>'radioGeslacht','oninput'=>'this.className'])}}Man
                {{ Form::radio('gender', 'Vrouw', ['id'=>'radioGeslacht','oninput'=>'this.className'])}}Vrouw
                {{ Form::radio('gender', 'Andere', ['id'=>'radioGeslacht','oninput'=>'this.className'])}}Andere
            </p>
            <p><label class="formLabel">Nationaliteit</label>{{ Form::text('txtNationaliteit', '', ['id'=>'txtNationaliteit','oninput'=>'this.className'])}}</p>
            <p><label class="formLabel">Geboortedatum</label>{{ Form::date('dateGeboorte', '', ['id'=>'dateGeboorte','oninput'=>'this.className','type'=>'date'])}}</p>
            <p><label class="formLabel">Geboorteplaats</label>{{ Form::text('txtGeboorteplaats', '', ['id'=>'txtGeboorteplaats','oninput'=>'this.className'])}}</p>
            <p><label class="formLabel">Adres</label>{{ Form::text('txtAdres', '', ['id'=>'txtAdres','oninput'=>'this.className'])}}</p>

            <p><label class="formLabel">Woonplaats</label>{{ Form::text('dropGemeente', '', ['id'=>'dropGemeente','oninput'=>'this.className'])}}</p>
            <p><label class="formLabel">Land</label>{{ Form::text('txtLand', '', ['id'=>'txtLand','oninput'=>'this.className'])}}</p>
            <p><label class="formLabel">Bankrekeningnummer (IBAN)</label>{{ Form::text('txtBank', '', ['id'=>'txtBank','oninput'=>'this.className', 'maxlength'=>34])}}</p>

        </div>

    <div class="tab"><h2 class="tabTitle">Contact gegevens:</h2>
            <p><label class="formLabel">E-mail adres (van de school)</label>{{ Form::email('txtEmail', '', ['id'=>'txtEmail','oninput'=>'this.className'])}}</p>
            <p><label class="formLabel">GSM-nummer</label>{{ Form::text('txtGsm', '', ['id'=>'txtGsm','oninput'=>'this.className'])}}</p>
            <p><label class="formLabel">Noodnummer 1</label>{{ Form::text('txtNoodnummer1', '', ['id'=>'txtNoodnummer1','oninput'=>'this.className'])}}</p>
            <p><label class="formLabel">Noodnummer 2</label>{{ Form::text('txtNoodnummer2', '', ['id'=>'txtNoodnummer2','oninput'=>'this.className', 'placeholder'=>'Niet verplicht'])}}</p>
        </div>

    <div class="tab"><h2 class="tabTitle">Medische gegevens:</h2>
            <p><label class="formLabel">Heeft u een operatie gehad in het afgelopen jaar of andere medische aandoening? (Allergie, ziekte, ...)</label><br>
                {{ Form::radio('check', '1', ['id'=>'radioMedisch','oninput'=>'this.className'])}}Ja
                {{ Form::radio('check', '0', ['id'=>'radioMedisch','oninput'=>'this.className'])}}Nee

            </p><br>
            <p><label class="formLabel">Wat houden deze in?</label>{{ Form::textarea('txtMedisch', '', ['id'=>'txtMedisch','oninput'=>'this.className','placeholder'=>'Niet verplicht'])}}</p>
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

    {{ Form::close() }}

    <script src="{{ URL::asset('/js/all.js') }}"></script>
    <script type="text/javascript">

        function checkMajor(){
            var study_id, major_name;
            console.log("in check major functie");
            @php {{$phpOpleidingen = $aOpleidingen;}} @endphp
            var opleidingen = @php {{echo json_encode($aOpleidingen);}}  @endphp ;
            console.log(opleidingen);
            var ArrayNotDone =true;
            var i=1;
            var studySelect = document.getElementsByName('dropOpleiding');
            console.log(studySelect);
            while(ArrayNotDone){
                if(opleidingen[i]==null){
                    ArrayNotDone=false;

                }
                else{
                    console.log(opleidingen[i]);
                    i++
                }
            }
        }

    </script>



@endsection