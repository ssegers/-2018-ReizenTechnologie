@extends("layouts.app")
@section('content')
    <div class="container border rounded margin-top-50 background-white">
        <h3 class="font-weight-bold color-dark-blue m-1"><span>{{$aUserData["username"]}}</span></h3>
        <form>
            <div class="row padding-10 pt-0">
                <div class="col color-dark-blue">
                    <h4><u>Algemeen</u></h4>
                    <label class="col-4 font-weight-bold">Naam:             </label>    <span class="col-4">{{$aUserData['last_name']}} </span><br/>
                    <label class="col-4 font-weight-bold">Voornaam:         </label>    <span class="col-4">{{$aUserData["first_name"]}}</span><br/>
                    <label class="col-4 font-weight-bold">Geslacht:         </label>    <span class="col-4">{{$aUserData['gender']}}</span><br/>
                    <label class="col-4 font-weight-bold">Klas:             </label>    <span class="col-4">{{$aUserData['study_name']}}</span><br/>
                    <label class="col-4 font-weight-bold">Afstuderrichting: </label>    <span class="col-4">{{$aUserData['major_name']}}</span><br/>
                    <label class="col-4 font-weight-bold">Reis:          </label>    <span class="col-4">{{$aUserData['name']}}</span><br/>

                    <h4><u>Financieel</u></h4>
                    <label class="col-4 font-weight-bold" for="name">IBAN:          </label>    <span class="col-4">{{$aUserData['iban']}}</span><br/>
                    <h4><u>Medisch</u></h4>
                    <label class="col-4 font-weight-bold" for="name">Behandeling:   </label>    <span class="col-4">@if($aUserData['medical_issue'])Ja @else Nee @endif</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Medische info: </label>    <span class="col-4">@if($aUserData['medical_issue']){{$aUserData['medical_info']}} @else / @endif</span><br/>
                </div>
                <div class="col color-dark-blue">
                    <h4><u>Geboorte</u></h4>
                    <label class="col-4 font-weight-bold" for="name">Geboortedatum: </label>    <span class="col-4">{{$aUserData['birthdate']}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Geboorteplaats:</label>    <span class="col-4">{{$aUserData['birthplace']}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Nationaliteit: </label>    <span class="col-4">{{$aUserData['nationality']}}</span><br/>

                    <h4><u>Woonplaats</u></h4>
                    <label class="col-4 font-weight-bold" for="name">Adres:         </label>    <span class="col-4">{{$aUserData['address']}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Gemeente:      </label>    <span class="col-4">{{$aUserData['city']}} {{$aUserData['zip_code']}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Land:          </label>    <span class="col-4">{{$aUserData['country']}}</span><br/>

                    <h4><u>Contact Info</u></h4>
                    <label class="col-4 font-weight-bold" for="name">Email:         </label>    <span class="col-4">{{$aUserData['email']}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Telefoon:      </label>    <span class="col-4">{{$aUserData['phone']}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Noodnummer 1:  </label>    <span class="col-4">{{$aUserData['emergency_phone_1']}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Noodnummer 2:  </label>    <span class="col-4">{{$aUserData['emergency_phone_2']}}</span>
                </div>
            </div>
            <div class="nav justify-content-center mb-3 font-weight-bold">
                <a class="nav-link nav-link-white-hover bg-dark-blue d-inline-flex m-1" href="/user/{{$sName}}/trip/travellers">Terug</a>
                <a class="nav-link nav-link-white-hover bg-dark-blue d-inline-flex m-1" href="/userinfo/{{$aUserData["username"]}}/edit">Aanpassen</a>
                <a class="nav-link nav-link-white-hover bg-dark-blue d-inline-flex m-1" href="/userinfo/{{$aUserData["username"]}}/delete">Verwijderen</a>
            </div>
        </form>
    </div>
@endsection