@extends("layouts.app")

@section('content')
    <style>
        .card {
            margin-bottom: 2em;
        }
    </style>
    <div class="container">
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
                            <div class="form-row">
                                <div class="col-5">Naam</div>
                                <div class="col-7">{{ $aUserData['last_name'] }}</div>
                            </div>
                            <div class="form-row">
                                <div class="col-5">Voornaam</div>
                                <div class="col-7">{{ $aUserData['first_name'] }}</div>
                            </div>
                            <div class="form-row">
                                <div class="col-5">Geslacht</div>
                                <div class="col-7">{{ $aUserData['gender'] }}</div>
                            </div>
                            <div class="form-row">
                                <div class="col-5">Klas</div>
                                <div class="col-7">{{ $aUserData['study_name'] }}</div>
                            </div>
                            <div class="form-row">
                                <div class="col-5">Afstudeerrichting</div>
                                <div class="col-7">{{ $aUserData['major_name'] }}</div>
                            </div>
                            <div class="form-row">
                                <div class="col-5">Reis</div>
                                <div class="col-7">{{ $aUserData['name'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header lead">Financieel</div>
                    <div class="card-body">
                        <div class="card-text">
                            <div class="form-row">
                                <div class="col-5">IBAN</div>
                                <div class="col-7">{{ $aUserData['iban'] }}</div>
                            </div>
                            <div class="form-row">
                                <div class="col-5">BIC</div>
                                <div class="col-7">{{ $aUserData['bic'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header lead">Woonplaats</div>
                    <div class="card-body">
                        <div class="card-text">
                            <div class="form-row">
                                <div class="col-5">Adres</div>
                                <div class="col-7">{{ $aUserData['address'] }}</div>
                            </div>
                            <div class="form-row">
                                <div class="col-5">Gemeente</div>
                                <div class="col-7">{{ $aUserData['city'] }} {{ $aUserData['zip_code'] }}</div>
                            </div>
                            <div class="form-row">
                                <div class="col-5">Land</div>
                                <div class="col-7">{{ $aUserData['country'] }}</div>
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
                            <div class="form-row">
                                <div class="col-5">Geboortedatum</div>
                                <div class="col-7">{{ $aUserData['birthdate'] }}</div>
                            </div>
                            <div class="form-row">
                                <div class="col-5">Geboorteplaats</div>
                                <div class="col-7">{{ $aUserData['birthplace'] }}</div>
                            </div>
                            <div class="form-row">
                                <div class="col-5">Nationaliteit</div>
                                <div class="col-7">{{ $aUserData['nationality'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header lead">Medisch</div>
                    <div class="card-body">
                        <div class="card-text">
                            <div class="form-row">
                                <div class="col-5">Behandeling of aandoening</div>
                                <div class="col-7">@if($aUserData['medical_issue'])Ja @else Nee @endif</div>
                            </div>
                            <div class="form-row">
                                <div class="col-5">Medische info</div>
                                <div class="col-7">@if($aUserData['medical_issue']){{$aUserData['medical_info']}} @else / @endif</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header lead">Contactinfo</div>
                    <div class="card-body">
                        <div class="card-text">
                            <div class="form-row">
                                <div class="col-5">Email</div>
                                <div class="col-7">{{ $aUserData['email'] }}</div>
                            </div>
                            <div class="form-row">
                                <div class="col-5">GSM</div>
                                <div class="col-7">{{ $aUserData['phone'] }}</div>
                            </div>
                            <div class="form-row">
                                <div class="col-5">Noodnummer 1</div>
                                <div class="col-7">{{ $aUserData['emergency_phone_1'] }}</div>
                            </div>
                            <div class="form-row">
                                <div class="col-5">Noodnummer 2</div>
                                <div class="col-7">{{ $aUserData['emergency_phone_2'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a class="btn btn-primary" href="/userinfo/{{$aUserData["username"]}}/edit">Aanpassen</a>
            </div>
        </div>
    </div>
    <div class="container border rounded margin-top-50 background-white">

        @if(!str_contains($sPath, 'profile'))
            <form method="POST" action="{{ route('user.destroy', $aUserData["username"]) }}" onsubmit="return confirm('Are you sure?')">
                @endif

                <h3 class="font-weight-bold color-dark-blue m-1">
                    <span>{{$aUserData["username"]}}</span>
                </h3>

                <div class="row padding-10 pt-0">
                    <div class="col color-dark-blue">
                        <h4>
                            <u>Algemeen</u>
                        </h4>

                        <label class="col-4 font-weight-bold">Naam:</label>
                        <span class="col-4">{{$aUserData['last_name']}} </span>
                        <br/>

                        <label class="col-4 font-weight-bold">Voornaam:</label>
                        <span class="col-4">{{$aUserData["first_name"]}}</span>
                        <br/>

                        <label class="col-4 font-weight-bold">Geslacht:</label>
                        <span class="col-4">{{$aUserData['gender']}}</span>
                        <br/>

                        <label class="col-4 font-weight-bold">Klas:</label>
                        <span class="col-4">{{$aUserData['study_name']}}</span>
                        <br/>

                        <label class="col-4 font-weight-bold">Afstuderrichting:</label>
                        <span class="col-4">{{$aUserData['major_name']}}</span>
                        <br/>

                        <label class="col-4 font-weight-bold">Reis:</label>
                        <span class="col-4">{{$aUserData['name']}}</span>
                        <br/>

                        <h4>
                            <u>Financieel</u>
                        </h4>

                        <label class="col-4 font-weight-bold">IBAN:</label>
                        <span class="col-4">{{$aUserData['iban']}}</span>
                        <br/>

                        <label class="col-4 font-weight-bold">BIC:</label>
                        <span class="col-4">{{$aUserData['bic']}}</span>
                        <br/>

                        <h4>
                            <u>Medisch</u>
                        </h4>

                        <label class="col-4 font-weight-bold">Behandeling:</label>
                        <span class="col-4">@if($aUserData['medical_issue'])Ja @else Nee @endif</span>
                        <br/>

                        <label class="col-4 font-weight-bold">Medische info: </label>
                        <span class="col-4">@if($aUserData['medical_issue']){{$aUserData['medical_info']}} @else / @endif</span>
                        <br/>
                    </div>

                    <div class="col color-dark-blue">
                        <h4>
                            <u>Geboorte</u>
                        </h4>

                        <label class="col-4 font-weight-bold">Geboortedatum:</label>
                        <span class="col-4">{{$aUserData['birthdate']}}</span>
                        <br/>

                        <label class="col-4 font-weight-bold">Geboorteplaats:</label>
                        <span class="col-4">{{$aUserData['birthplace']}}</span>
                        <br/>

                        <label class="col-4 font-weight-bold">Nationaliteit:</label>
                        <span class="col-4">{{$aUserData['nationality']}}</span>
                        <br/>

                        <h4>
                            <u>Woonplaats</u>
                        </h4>

                        <label class="col-4 font-weight-bold">Adres:</label>
                        <span class="col-4">{{$aUserData['address']}}</span>
                        <br/>

                        <label class="col-4 font-weight-bold">Gemeente:</label>
                        <span class="col-4">{{$aUserData['city']}} {{$aUserData['zip_code']}}</span>
                        <br/>

                        <label class="col-4 font-weight-bold">Land:</label>
                        <span class="col-4">{{$aUserData['country']}}</span>
                        <br/>

                        <h4>
                            <u>Contact Info</u>
                        </h4>

                        <label class="col-4 font-weight-bold">Email:</label>
                        <span class="col-4">{{$aUserData['email']}}</span>
                        <br/>

                        <label class="col-4 font-weight-bold">GSM-nummer:</label>
                        <span class="col-4">{{$aUserData['phone']}}</span>
                        <br/>

                        <label class="col-4 font-weight-bold">Noodnummer 1:</label>
                        <span class="col-4">{{$aUserData['emergency_phone_1']}}</span>
                        <br/>

                        <label class="col-4 font-weight-bold">Noodnummer 2:</label>
                        <span class="col-4">{{$aUserData['emergency_phone_2']}}</span>
                    </div>
                </div>

                <div class="nav justify-content-center mb-3 font-weight-bold">

                    @if(!str_contains($sPath, 'profile'))
                        <a class="nav-link nav-link-white-hover bg-dark-blue d-inline-flex m-1" href="{{route("filter")}}">Terug</a>
                        <a class="nav-link nav-link-white-hover bg-dark-blue d-inline-flex m-1" href="/userinfo/{{$aUserData["username"]}}/edit">Aanpassen</a>
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="nav-link nav-link-white-hover bg-dark-blue d-inline-flex m-1 border-0 font-weight-bold text-white" type="submit">Verwijderen</button>
                    @endif

                    @if(str_contains($sPath, 'profile'))
                        <a class="nav-link nav-link-white-hover bg-dark-blue d-inline-flex m-1" href="/profile/edit">Aanpassen</a>
                    @endif

                </div>
            </form>
    </div>
@endsection