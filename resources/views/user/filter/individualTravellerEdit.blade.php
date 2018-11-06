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
        {{ Form::open(array('url' => "/userinfo/".$aUserData["username"]."/update", 'method' => 'post')) }}
            <div class="row padding-10">
                <div class="col color-dark-blue">
                    <h4>Algemeen</h4>
                    <label class="col-4 font-weight-bold" for="LastName">Naam:              </label>    <input id="LastName"     name="LastName"     class="col-6" type="text" value={{$aUserData["last_name"]}}>   <br/>
                    <label class="col-4 font-weight-bold" for="FirstName">Voornaam:         </label>    <input id="FirstName"    name="FirstName"    class="col-6" type="text" value={{$aUserData["first_name"]}}>  <br/>
                    <label class="col-4 font-weight-bold" for="Username">R-Nummer:          </label>    <input id="Username"     name="Username"     class="col-6" type="text" value={{$aUserData["username"]}}>    <br/>
                    <label class="col-4 font-weight-bold" for="Gender">Geslacht:            </label>    <input                   name="Gender"       class="" type="radio" value="man" @if($aUserData["gender"] == "man") checked @endif>Man <input name="Gender" class="" type="radio" value="vrouw" @if($aUserData["gender"] == "vrouw") checked @endif>Vrouw <br/>
                    <label class="col-4 font-weight-bold" for="Trip">Reis:                  </label>    <select id="Trip"        name="Trip"         class="col-6">
                        @foreach($oTrips as $oTrip)
                            <option value="{{ $oTrip->trip_id}}" @if($oTrip->trip_id == $aUserData["trip_id"]) selected @endif>    {{ $oTrip->name}}   </option>
                        @endforeach
                    </select>                                              <br/>
                    <h4>Financieel</h4>
                    <label class="col-4 font-weight-bold" for="IBAN">IBAN:                  </label>    <input id="IBAN"         name="IBAN"         class="col-6" type="text" value={{$aUserData['iban']}}>        <br/>
                    <h4>Medisch</h4>
                    <label class="col-4 font-weight-bold" for="MedicalIssue">Behandeling:   </label>    <input                   name="MedicalIssue" class="" type="radio" value="1" @if($aUserData["medical_issue"] == "1") checked @endif>Ja <input name="MedicalIssue" type="radio" value="0" @if($aUserData["medical_issue"] == "0") checked @endif>Nee <br/>
                    <label class="col-4 font-weight-bold" for="MedicalInfo">Medische info:  </label>    <input id="MedicalInfo"  name="MedicalInfo"  class="col-6" type="text" value=@if($aUserData['medical_issue']){{$aUserData['medical_info']}} @endif><br/>
                </div>
                <div class="col color-dark-blue">
                    <h4>Geboorte</h4>
                    <label class="col-4 font-weight-bold" for="BirthDate">Geboortedatum:    </label>    <input id="BirthDate"    name="BirthDate"    class="col-6" type="text" value={{$aUserData['birthdate']}}>   <br/>
                    <label class="col-4 font-weight-bold" for="Birthplace">Geboorteplaats:  </label>    <input id="Birthplace"   name="Birthplace"   class="col-6" type="text" value={{$aUserData['birthplace']}}>  <br/>
                    <label class="col-4 font-weight-bold" for="Nationality">Nationaliteit:  </label>    <input id="Nationality"  name="Nationality"  class="col-6" type="text" value={{$aUserData['nationality']}}> <br/>
                    <h4>Woonplaats</h4>
                    <label class="col-4 font-weight-bold" for="Address">Adres:              </label>    <input id="Address"      name="Address"      class="col-6" type="text" value={{$aUserData['address']}}>     <br/>
                    <label class="col-4 font-weight-bold" for="City">Gemeente:              </label>    <select id="City"        name="City"         class="col-6">
                        @foreach($oZips as $oZip)
                            <option value="{{ $oZip->zip_id}}" @if($oZip->zip_id == $aUserData["zip_id"]) selected @endif>{{$oZip->city}} {{$oZip->zip_code}}</option>
                        @endforeach
                    </select>                                              <br/>
                    <label class="col-4 font-weight-bold" for="Country">Land:               </label>    <input id="Country"      name="Country"      class="col-6" type="text" value={{$aUserData['country']}}>     <br/>
                    <h4>Contact Info</h4>
                    <label class="col-4 font-weight-bold" for="Email">Email:                </label>    <input id="Email"        name="Email"        class="col-6" type="text" value={{$aUserData['email']}}>       <br/>
                    <label class="col-4 font-weight-bold" for="Phone">Telefoon:             </label>    <input id="Phone"        name="Phone"        class="col-6" type="text" value={{$aUserData['phone']}}>       <br/>
                    <label class="col-4 font-weight-bold" for="icePhone1">Noodnummer 1:     </label>    <input id="icePhone1"    name="icePhone1"    class="col-6" type="text" value={{$aUserData['emergency_phone_1']}}><br/>
                    <label class="col-4 font-weight-bold" for="icePhone2">Noodnummer 2:     </label>    <input id="icePhone2"    name="icePhone2"    class="col-6" type="text" value={{$aUserData['emergency_phone_2']}}>
                </div>
            </div>
            <div class="nav justify-content-center mb-3 font-weight-bold">
                <a class="nav-link nav-link-white-hover bg-dark-blue d-inline-flex m-1" href="/userinfo/{{$aUserData["username"]}}">Annuleren</a>
                {{ Form::submit('Opslaan', ['class' => 'nav-link nav-link-white-hover bg-dark-blue d-inline-flex m-1 border-0 font-weight-bold'])}}
            </div>
        {{ Form::close() }}
    </div>
@endsection