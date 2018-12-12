@extends("layouts.app")

@section('content')
    <style>
        .card {
            margin-bottom: 2em;
        }
    </style>

    @if(!str_contains($sPath, 'profile'))
        <form method="POST" action="{{ route('user.destroy', $aUserData["username"]) }}" onsubmit="return confirm('Are you sure?')">
            @endif
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
                                        <div class="col-5">Richting</div>
                                        <div class="col-7">{{ $aUserData['study_name'] }}</div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-5">Afstudeerrichting</div>
                                        <div class="col-7">{{ $aUserData['major_name'] }}</div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-5">Reis</div>
                                        <div class="col-7">{{ $aUserData['name'] }} {{ $aUserData['year'] }}</div>
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
                                        <div class="col-7">{{$aUserData['medical_info']}}</div>
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
                        @if(!str_contains($sPath, 'profile'))
                            <a class="btn btn-info" href="{{route("filter")}}">Terug</a>
                            <a class="btn btn-primary" href="/userinfo/{{$aUserData["username"]}}/edit">Aanpassen</a>
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger" type="submit">Verwijderen</button>
                        @endif

                        @if(str_contains($sPath, 'profile'))
                            <a class="btn btn-primary" href="/profile/edit">Aanpassen</a>
                        @endif
                    </div>
                </div>
            </div>
            @if(!str_contains($sPath, 'profile'))
        </form>
    @endif
@endsection