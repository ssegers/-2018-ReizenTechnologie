@extends("layouts.app")
@section('content')
    <style>
        .card {
            margin-bottom: 2em;
        }
    </style>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container">
            @if(str_contains($sPath, 'profile'))
                {{ Form::open(array('url' => "/profile/".$aUserData["username"]."/update", 'method' => 'post', 'name' => 'myForm')) }}
            @else
                {{ Form::open(array('url' => "/userinfo/".$aUserData["username"]."/update", 'method' => 'post', 'name' => 'myForm')) }}
            @endif

                <div class="row">
                    <div class="col">
                        <h2>{{ $aUserData['username'] }}</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg">
                        <div class="card">
                            <div class="card-header lead">Algemeen</div>
                            <div class="card-body">
                                <div class="card-text">
                                    <div class="form-row form-group">
                                        <div class="col-5">{{ Form::label('LastName', 'Naam*') }}</div>
                                        <div class="col-7">{{ Form::text('LastName', $aUserData['last_name'], ['class' => 'form-control', 'required']) }}</div>
                                    </div>
                                    <div class="form-row form-group">
                                        <div class="col-5">{{ Form::label('FirstName', 'Voornaam*') }}</div>
                                        <div class="col-7">{{ Form::text('FirstName', $aUserData['first_name'], ['class' => 'form-control', 'required']) }}</div>
                                    </div>
                                    <div class="form-row form-group">
                                        <div class="col-5">{{ Form::label('Gender', 'Geslacht*') }}</div>
                                        <div class="col-7">
                                            <input id="Gender" name="Gender" type="radio" value="Man" @if($aUserData["gender"] == "Man") checked @endif>Man
                                            <input id="Gender" name="Gender" type="radio" value="Vrouw" @if($aUserData["gender"] == "Vrouw") checked @endif>Vrouw
                                            <input id="Gender" name="Gender" type="radio" value="Andere" @if($aUserData["gender"] == "Andere") checked @endif>Andere
                                        </div>
                                    </div>
                                    <div class="form-row form-group">
                                        <div class="col-5">{{ Form::label('Study', 'Richting*') }}</div>
                                        <div class="col-7">
                                            <select id="Study" name="Study" required class="form-control cascadingMajor" data-dependent="Major">
                                                @foreach($oStudies as $oStudy)
                                                    <option value="{{ $oStudy->study_id}}" @if($oStudy->study_id == $aUserData["study_id"]) selected @endif> {{ $oStudy->study_name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row form-group">
                                        <div class="col-5">{{ Form::label('Major', 'Afstudeerrichting*') }}</div>
                                        <div class="col-7">
                                            <select id="Major" name="Major" required class="form-control">
                                                @foreach($oMajors as $oMajor)
                                                    <option value="{{ $oMajor->major_id}}" @if($oMajor->major_id == $aUserData["major_id"]) selected @endif> {{ $oMajor->major_name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row form-group">
                                        <div class="col-5">{{ Form::label('Trip', 'Reis') }}</div>
                                        <div class="col-7">
                                            {{ $aUserData['name'] }} {{ $aUserData['year'] }}
                                            {{--<select id="Trip" name="Trip" required class="form-control">--}}
                                                {{--@foreach($oTrips as $oTrip)--}}
                                                    {{--<option value="{{ $oTrip->trip_id }}" @if($oTrip->trip_id == $aUserData["trip_id"]) selected @endif> {{ $oTrip->name }} {{ $oTrip->year }} </option>--}}
                                                {{--@endforeach--}}
                                            {{--</select>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header lead">Financieel</div>
                            <div class="card-body">
                                <div class="card-text">
                                    <div class="form-row form-group">
                                        <div class="col-5">{{ Form::label('IBAN', 'IBAN*') }}</div>
                                        <div class="col-7">{{ Form::text('IBAN', $aUserData['iban'], ['class' => 'form-control', 'required']) }}</div>
                                    </div>
                                    <div class="form-row form-group">
                                        <div class="col-5">{{ Form::label('BIC', 'BIC*') }}</div>
                                        <div class="col-7">{{ Form::text('BIC', $aUserData['bic'], ['class' => 'form-control', 'required']) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header lead">Woonplaats</div>
                            <div class="card-body">
                                <div class="card-text">
                                    <div class="form-row form-group">
                                        <div class="col-5">{{ Form::label('Address', 'Adres*') }}</div>
                                        <div class="col-7">{{ Form::text('Address', $aUserData['address'], ['class' => 'form-control', 'required']) }}</div>
                                    </div>
                                    <div class="form-row form-group">
                                        <div class="col-5">{{ Form::label('City', 'Gemeente*') }}</div>
                                        <div class="col-7">
                                            <select id="City" name="City" required class="form-control">
                                                @foreach($oZips as $oZip)
                                                    <option value="{{ $oZip->zip_id}}" @if($oZip->zip_id == $aUserData["zip_id"]) selected @endif>{{$oZip->city}} {{$oZip->zip_code}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row form-group">
                                        <div class="col-5">{{ Form::label('Country', 'Land*') }}</div>
                                        <div class="col-7">{{ Form::text('Country', $aUserData['country'], ['class' => 'form-control', 'required']) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="card">
                            <div class="card-header lead">Geboorte</div>
                            <div class="card-body">
                                <div class="card-text">
                                    <div class="form-row form-group">
                                        <div class="col-5">{{ Form::label('BirthDate', 'Geboortedatum*') }}</div>
                                        <div class="col-7">
                                            {{ Form::date('BirthDate', $aUserData["birthdate"], ['id'=>'BirthDate','type'=>'date', 'class' => 'form-control', 'required'])}}
                                        </div>
                                    </div>
                                    <div class="form-row form-group">
                                        <div class="col-5">{{ Form::label('Birthplace', 'Geboorteplaats*') }}</div>
                                        <div class="col-7">{{ Form::text('Birthplace', $aUserData['birthplace'], ['class' => 'form-control', 'required']) }}</div>
                                    </div>
                                    <div class="form-row form-group">
                                        <div class="col-5">{{ Form::label('Nationality', 'Nationaliteit*') }}</div>
                                        <div class="col-7">{{ Form::text('Nationality', $aUserData['nationality'], ['class' => 'form-control', 'required']) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header lead">Medisch</div>
                            <div class="card-body">
                                <div class="card-text">
                                    <div class="form-row form-group">
                                        <div class="col-5">{{ Form::label('MedicalIssue', 'Behandeling of aandoening*') }}</div>
                                        <div class="col-7">
                                            <input id="MedicalIssue" name="MedicalIssue"  type="radio" value="1" @if($aUserData["medical_issue"] == "1") checked @endif>Ja
                                            <input id="MedicalIssue" name="MedicalIssue"  type="radio" value="0" @if($aUserData["medical_issue"] == "0") checked @endif>Nee
                                        </div>
                                    </div>
                                    <div class="form-row form-group">
                                        <div class="col-5">{{ Form::label('MedicalInfo', 'Medische info') }}</div>
                                        <div class="col-7">
                                            <textarea id="MedicalInfo" name="MedicalInfo" class="form-control"  rows="5">{{ $aUserData['medical_info'] }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header lead">Contactinfo</div>
                            <div class="card-body">
                                <div class="card-text">
                                    <div class="form-row form-group">
                                        <div class="col-5">{{ Form::label('Email', 'Email*') }}</div>
                                        <div class="col-7">{{ Form::email('Email', $aUserData['email'], ['class' => 'form-control', 'required']) }}</div>
                                    </div>
                                    <div class="form-row form-group">
                                        <div class="col-5">{{ Form::label('Phone', 'GSM*') }}</div>
                                        <div class="col-7">{{ Form::text('Phone', $aUserData['phone'], ['class' => 'form-control', 'required']) }}</div>
                                    </div>
                                    <div class="form-row form-group">
                                        <div class="col-5">{{ Form::label('icePhone1', 'Noodnummer 1*') }}</div>
                                        <div class="col-7">{{ Form::text('icePhone1', $aUserData['emergency_phone_1'], ['class' => 'form-control', 'required']) }}</div>
                                    </div>
                                    <div class="form-row form-group">
                                        <div class="col-5">{{ Form::label('icePhone2', 'Noodnummer 2') }}</div>
                                        <div class="col-7">{{ Form::text('icePhone2', $aUserData['emergency_phone_2'], ['class' => 'form-control']) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        @if(str_contains($sPath, 'profile'))
                            <a class="btn btn-danger" href="/profile">Annuleren</a>
                        @else
                            <a class="btn btn-danger" href="/userinfo/{{$aUserData["username"]}}">Annuleren</a>
                        @endif
                        {{ Form::submit('Opslaan', ['class' => 'btn btn-primary'])}}
                    </div>
                </div>
                {{csrf_field()}}
            {{ Form::close() }}
        </div>
    <script src="{{ URL::asset('/js/cascadingDropDownStudyMajors.js') }}">
    </script>
    <script type="text/javascript">
        var radio = document.getElementsByName("MedicalIssue");
        for(var i =0; i<radio.length; i++){
            radio[i].addEventListener('change', function(){

                var radio = document.getElementsByName("MedicalIssue");
                var value = null;
                for(var i = 0; i< radio.length; i++){
                    if(radio[i].checked){
                        value= radio[i].value;
                    }
                }

                if(value == 0){
                    if (confirm("Hierbij wordt uw opgeslagen medische info verwijdert, bent u zeker dat u wil doorgaan?"))  {
                        var medic = document.getElementById("MedicalInfo");
                        medic.disabled = true;
                        medic.value = null;
                    }
                    else {
                        document.getElementsByName("MedicalIssue").value=0;
                    }
                }

                LaatTextAreaZien();
            })
        }

        function LaatTextAreaZien(){
            var radio = document.getElementsByName("MedicalIssue");
            var value = null;
            for(var i = 0; i< radio.length; i++){
                if(radio[i].checked){
                  value= radio[i].value;
                }
            }
            var textarea = document.getElementById("MedicalInfo");
            if(value == 0){
                document.getElementById("MedicalInfo").disabled = true;
            }
            else{
                document.getElementById("MedicalInfo").disabled = false;
            }
        }

        LaatTextAreaZien();

    </script>
@endsection
