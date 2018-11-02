@extends("layouts.app")
@section('content')
    <div class="container border rounded margin-top-50 background-white">
        <form>
            <div class="row padding-10">
                <div class="col color-dark-blue">
                    <h4>Algemeen</h4>
                    <label class="col-4 font-weight-bold" for="txtLastName">Naam:   </label>    <input id="txtLastName" class="col-4" type="text" value={{$aUserData["last_name"]}}><br/>
                    <label class="col-4 font-weight-bold" for="name">Voornaam:      </label>    <input id="txtLastName" class="col-4" type="text" value={{$aUserData["first_name"]}}><br/>
                    <label class="col-4 font-weight-bold" for="name">R-Nummer:      </label>    <input id="txtLastName" class="col-4" type="text" value={{$aUserData["username"]}}><br/>
                    <label class="col-4 font-weight-bold" for="name">Geslacht:      </label>    <input id="txtLastName" class="col-4" type="text" value={{$aUserData['gender']}}><br/>
                    <label class="col-4 font-weight-bold" for="name">Reis:          </label>    <input id="txtLastName" class="col-4" type="text" value={{$aUserData['name']}}><br/>

                    <h4>Financieel</h4>
                    <label class="col-4 font-weight-bold" for="name">IBAN:          </label>    <input id="txtLastName" class="col-4" type="text" value={{$aUserData['iban']}}><br/>
                    <h4>Medisch</h4>
                    <label class="col-4 font-weight-bold" for="name">Behandeling:   </label>    <input id="txtLastName" class="col-4" type="text" value=@if($aUserData['medical_issue'])Ja @else Nee @endif><br/>
                    <label class="col-4 font-weight-bold" for="name">Medische info: </label>    <input id="txtLastName" class="col-4" type="text" value=@if($aUserData['medical_issue']){{$aUserData['medical_info']}} @else / @endif><br/>
                </div>
                <div class="col color-dark-blue">
                    <h4>Geboorte</h4>
                    <label class="col-4 font-weight-bold" for="name">Geboortedatum: </label>    <input id="txtLastName" class="col-4" type="text" value={{$aUserData['birthdate']}}><br/>
                    <label class="col-4 font-weight-bold" for="name">Geboorteplaats:</label>    <input id="txtLastName" class="col-4" type="text" value={{$aUserData['birthplace']}}><br/>
                    <label class="col-4 font-weight-bold" for="name">Nationaliteit: </label>    <input id="txtLastName" class="col-4" type="text" value={{$aUserData['nationality']}}><br/>

                    <h4>Woonplaats</h4>
                    <label class="col-4 font-weight-bold" for="name">Adres:         </label>    <input id="txtLastName" class="col-4" type="text" value={{$aUserData['address']}}><br/>
                    <label class="col-4 font-weight-bold" for="name">Gemeente:      </label>    <input id="txtLastName" class="col-4" type="text" value={{$aUserData['city']}} {{$aUserData[0]['zip_code']}}><br/>
                    <label class="col-4 font-weight-bold" for="name">Land:          </label>    <input id="txtLastName" class="col-4" type="text" value={{$aUserData['country']}}><br/>

                    <h4>Contact Info</h4>
                    <label class="col-4 font-weight-bold" for="name">Email:         </label>    <input id="txtLastName" class="col-4" type="text" value={{$aUserData['email']}}><br/>
                    <label class="col-4 font-weight-bold" for="name">Telefoon:      </label>    <input id="txtLastName" class="col-4" type="text" value={{$aUserData['phone']}}><br/>
                    <label class="col-4 font-weight-bold" for="name">Noodnummer 1:  </label>    <input id="txtLastName" class="col-4" type="text" value={{$aUserData['emergency_phone_1']}}><br/>
                    <label class="col-4 font-weight-bold" for="name">Noodnummer 2:  </label>    <input id="txtLastName" class="col-4" type="text" value={{$aUserData['emergency_phone_2']}}>
                </div>
            </div>
            <div class="nav justify-content-center mb-3 font-weight-bold">
                <a class="nav-link nav-link-white-hover bg-dark-blue d-inline-flex mr-1" href="/userinfo/{{$aUserData["username"]}}">Annuleren</a>
                <a class="nav-link nav-link-white-hover bg-dark-blue d-inline-flex ml-1" href="/userinfo/{{$aUserData["username"]}}/update">Opslaan</a>
            </div>
        </form>
    </div>
@endsection