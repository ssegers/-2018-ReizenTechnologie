@extends("layouts.app")
@section('content')
    <div class="container border rounded margin-top-50 background-white">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(str_contains($sPath, 'profile'))
            {{ Form::open(array('url' => "/profile/".$aUserData["username"]."/update", 'method' => 'post')) }}
        @else
            {{ Form::open(array('url' => "/userinfo/".$aUserData["username"]."/update", 'method' => 'post')) }}
        @endif

        <h3 class="font-weight-bold color-dark-blue m-1">
            <span>{{$aUserData["username"]}}</span>
        </h3>
        <div class="row padding-10 pt-0">
            <div class="col color-dark-blue">
                <h4>
                    <u>Algemeen</u>
                </h4>

                <label class="col-4 font-weight-bold" for="LastName">Naam:</label>
                <input id="LastName" name="LastName" required class="col-6" type="text" value="{{$aUserData["last_name"]}}">
                <br/>

                <label class="col-4 font-weight-bold" for="FirstName">Voornaam:</label>
                <input id="FirstName" name="FirstName" required class="col-6" type="text" value="{{$aUserData["first_name"]}}">
                <br/>

                <label class="col-4 font-weight-bold" for="Gender">Geslacht:</label>
                <input id="Gender" name="Gender" type="radio" value="Man" @if($aUserData["gender"] == "Man") checked @endif>Man
                <input id="Gender" name="Gender" type="radio" value="Vrouw" @if($aUserData["gender"] == "Vrouw") checked @endif>Vrouw
                <input id="Gender" name="Gender" type="radio" value="Andere" @if($aUserData["gender"] == "Andere") checked @endif>Andere
                <br/>

                <label class="col-4 font-weight-bold" for="Study">Klas:</label>
                <select id="Study" name="Study" required class="col-6 cascadingMajor" data-dependent="Major">
                    @foreach($oStudies as $oStudy)
                        <option value="{{ $oStudy->study_id}}" @if($oStudy->study_id == $aUserData["study_id"]) selected @endif> {{ $oStudy->study_name }} </option>
                    @endforeach
                </select>
                <br/>

                <label class="col-4 font-weight-bold" for="Major">Afstudeerrichting:</label>
                <select id="Major" name="Major" required class="col-6">
                    @foreach($oMajors as $oMajor)
                        <option value="{{ $oMajor->major_id}}" @if($oMajor->major_id == $aUserData["major_id"]) selected @endif> {{ $oMajor->major_name }} </option>
                    @endforeach
                </select>
                <br/>

                <label class="col-4 font-weight-bold" for="Trip">Reis:</label>
                <select id="Trip" name="Trip" required class="col-6">
                    @foreach($oTrips as $oTrip)
                        <option value="{{ $oTrip->trip_id }}" @if($oTrip->trip_id == $aUserData["trip_id"]) selected @endif> {{ $oTrip->name }} </option>
                    @endforeach
                </select>
                <br/>

                <h4>
                    <u>Financieel</u>
                </h4>

                <label class="col-4 font-weight-bold" for="IBAN">IBAN:</label>
                <input id="IBAN" name="IBAN" required class="col-6" type="text" value="{{$aUserData['iban']}}">
                <br/>

                <h4>
                    <u>Medisch</u>
                </h4>

                <label class="col-4 font-weight-bold" for="MedicalIssue">Behandeling:</label>
                <input id="MedicalIssue" name="MedicalIssue" type="radio" value="1" @if($aUserData["medical_issue"] == "1") checked @endif>Ja
                <input id="MedicalIssue" name="MedicalIssue" type="radio" value="0" @if($aUserData["medical_issue"] == "0") checked @endif>Nee
                <br/>

                <label class="col-4 font-weight-bold" for="MedicalInfo">Medische info:</label>
                <textarea id="MedicalInfo" name="MedicalInfo"class="col-6">
                    @if($aUserData['medical_issue']) {{$aUserData['medical_info']}} @endif
                </textarea>
                <br/>
            </div>

            <div class="col color-dark-blue">
                <h4>
                    <u>Geboorte</u>
                </h4>

                <label class="col-4 font-weight-bold" for="BirthDate">Geboortedatum:</label>
                {{ Form::date('BirthDate', $aUserData["birthdate"], ['id'=>'BirthDate','oninput'=>'this.className','type'=>'date', 'class' => 'col-6'])}}
                <br/>

                <label class="col-4 font-weight-bold" for="Birthplace">Geboorteplaats:</label>
                <input id="Birthplace" name="Birthplace" required class="col-6" type="text" value="{{$aUserData['birthplace']}}">
                <br/>

                <label class="col-4 font-weight-bold" for="Nationality">Nationaliteit:</label>
                <input id="Nationality" name="Nationality" required class="col-6" type="text" value="{{$aUserData['nationality']}}">
                <br/>

                <h4>
                    <u>Woonplaats</u>
                </h4>

                <label class="col-4 font-weight-bold" for="Address">Adres:</label>
                <input id="Address" name="Address" required class="col-6" type="text" value="{{$aUserData['address']}}">
                <br/>

                <label class="col-4 font-weight-bold" for="City">Gemeente:</label>
                <select id="City" name="City" required class="col-6">
                    @foreach($oZips as $oZip)
                        <option value="{{ $oZip->zip_id}}" @if($oZip->zip_id == $aUserData["zip_id"]) selected @endif>{{$oZip->city}} {{$oZip->zip_code}}</option>
                    @endforeach
                </select>
                <br/>

                <label class="col-4 font-weight-bold" for="Country">Land:</label>
                <input id="Country" name="Country" required class="col-6" type="text" value="{{$aUserData['country']}}">
                <br/>

                <h4>
                    <u>Contact Info</u>
                </h4>

                <label class="col-4 font-weight-bold" for="Email">Email:</label>
                <span class="col-4">{{$aUserData['email']}}</span>
                <br/>

                <label class="col-4 font-weight-bold" for="Phone">GSM-nummer:</label>
                <input id="Phone" name="Phone" required class="col-6" type="text" value="{{$aUserData['phone']}}">
                <br/>

                <label class="col-4 font-weight-bold" for="icePhone1">Noodnummer 1:</label>
                <input id="icePhone1" name="icePhone1" required class="col-6" type="text" value="{{$aUserData['emergency_phone_1']}}">
                <br/>

                <label class="col-4 font-weight-bold" for="icePhone2">Noodnummer 2:</label>
                <input id="icePhone2" name="icePhone2" class="col-6" type="text" value="{{$aUserData['emergency_phone_2']}}">
            </div>
        </div>

        <div class="nav justify-content-center mb-3 font-weight-bold">

            @if(str_contains($sPath, 'profile'))
                <a class="nav-link nav-link-white-hover bg-dark-blue d-inline-flex m-1" href="/profile">Annuleren</a>
            @else
                <a class="nav-link nav-link-white-hover bg-dark-blue d-inline-flex m-1" href="/userinfo/{{$aUserData["username"]}}">Annuleren</a>
            @endif

            {{ Form::submit('Opslaan', ['class' => 'nav-link nav-link-white-hover bg-dark-blue d-inline-flex m-1 border-0 font-weight-bold'])}}

        </div>
        {{csrf_field()}}
        {{ Form::close() }}
    </div>
    <script src="{{ URL::asset('/js/cascadingDropDownStudyMajors.js') }}"></script>
@endsection
