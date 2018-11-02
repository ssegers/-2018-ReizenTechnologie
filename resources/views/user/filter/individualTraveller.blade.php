@extends("layouts.app")
@section('content')
    <div class="container border rounded margin-top-50 background-white">
        <form>
            <div class="row padding-10">
                <div class="col color-dark-blue">
                    <h4>Algemeen</h4>
                    <label class="col-4 font-weight-bold" for="name">Naam:          </label>    <span class="col-4">{{$aUserData['last_name']}} </span><br/>
                    <label class="col-4 font-weight-bold" for="name">Voornaam:      </label>    <span class="col-4">{{$aUserData["first_name"]}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">R-Nummer:      </label>    <span class="col-4">{{$aUserData["username"]}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Geslacht:      </label>    <span class="col-4">{{$aUserData['gender']}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Reis:          </label>    <span class="col-4">{{$aUserData['name']}}</span><br/>

                    <h4>Financieel</h4>
                    <label class="col-4 font-weight-bold" for="name">IBAN:          </label>    <span class="col-4">{{$aUserData['iban']}}</span><br/>
                    <h4>Medisch</h4>
                    <label class="col-4 font-weight-bold" for="name">Behandeling:   </label>    <span class="col-4">@if($aUserData['medical_issue'])Ja @else Nee @endif</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Medische info: </label>    <span class="col-4">@if($aUserData['medical_issue']){{$aUserData['medical_info']}} @else / @endif</span><br/>
                </div>
                <div class="col color-dark-blue">
                    <h4>Geboorte</h4>
                    <label class="col-4 font-weight-bold" for="name">Geboortedatum: </label>    <span class="col-4">{{$aUserData['birthdate']}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Geboorteplaats:</label>    <span class="col-4">{{$aUserData['birthplace']}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Nationaliteit: </label>    <span class="col-4">{{$aUserData['nationality']}}</span><br/>

                    <h4>Woonplaats</h4>
                    <label class="col-4 font-weight-bold" for="name">Adres:         </label>    <span class="col-4">{{$aUserData['address']}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Gemeente:      </label>    <span class="col-4">{{$aUserData['city']}} {{$aUserData[0]['zip_code']}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Land:          </label>    <span class="col-4">{{$aUserData['country']}}</span><br/>

                    <h4>Contact Info</h4>
                    <label class="col-4 font-weight-bold" for="name">Email:         </label>    <span class="col-4">{{$aUserData['email']}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Telefoon:      </label>    <span class="col-4">{{$aUserData['phone']}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Noodnummer 1:  </label>    <span class="col-4">{{$aUserData['emergency_phone_1']}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Noodnummer 2:  </label>    <span class="col-4">{{$aUserData['emergency_phone_2']}}</span>
                </div>
            </div>
            <div class="nav justify-content-center mb-3 font-weight-bold">
                <a class="nav-link nav-link-white-hover bg-dark-blue d-inline-flex mr-1" href="/userinfo/{{$aUserData["username"]}}/edit">Aanpassen</a>
                <a class="nav-link nav-link-white-hover bg-dark-blue d-inline-flex ml-1" href="/userinfo/{{$aUserData["username"]}}/delete">Verwijderen</a>
            </div>
        </form>
    </div>
@endsection