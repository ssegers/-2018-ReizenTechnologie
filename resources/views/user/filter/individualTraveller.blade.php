@extends("layouts.app")

@section('content')





    <div class="container border rounded margin-top-50 background-white">
        <form>
            <div class="row padding-10">
                <div class="col color-dark-blue">
                    <h4>Algemeen</h4>
                    <label class="col-4 font-weight-bold" for="name">Naam: </label>            <span class="col-4">{{$aUserData[0]['last_name']}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Voornaam: </label>        <span class="col-4">{{$aUserData[0]["first_name"]}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">R-Nummer: </label>        <span class="col-4">{{$aUserData[0]["user_name"]}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Geslacht: </label>        <span class="col-4">{{$aUserData[0]['gender']}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Reis: </label>            <span class="col-4">{{$aUserData[0]['trip_name']}}</span><br/>

                    <h4>Financieel</h4>
                    <label class="col-4 font-weight-bold" for="name">IBAN: </label>            <span class="col-4">{{$aUserData[0]['iban']}}</span><br/>
                    <h4>Medisch</h4>
                    <label class="col-4 font-weight-bold" for="name">Behandeling:</label>      <span class="col-4">@if($aUserData[0]['medical_issue'])Ja @else Nee @endif</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Medische info: </label>   <span class="col-4">@if($aUserData[0]['medical_issue']){{$aUserData['medical_info']}} @else / @endif</span><br/>
                </div>
                <div class="col color-dark-blue">
                    <h4>Geboorte</h4>
                    <label class="col-4 font-weight-bold" for="name">Geboortedatum: </label>   <span class="col-4">{{$aUserData[0]['birthdate']}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Geboorteplaats: </label>  <span class="col-4">{{$aUserData[0]['birthplace']}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Nationaliteit: </label>   <span class="col-4">{{$aUserData[0]['nationality']}}</span><br/>

                    <h4>Woonplaats</h4>
                    <label class="col-4 font-weight-bold" for="name">Adres:  </label>          <span class="col-4">{{$aUserData[0]['address']}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Gemeente: </label>        <span class="col-4">{{$aUserData[0]['city']}} {{$aUserData[0]['zip_code']}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Land: </label>            <span class="col-4">{{$aUserData[0]['country']}}</span><br/>

                    <h4>Contact Info</h4>
                    <label class="col-4 font-weight-bold" for="name">Email: </label>           <span class="col-4">{{$aUserData[0]['email']}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Telefoon: </label>        <span class="col-4">{{$aUserData[0]['phone']}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Noodnummer 1: </label>    <span class="col-4">{{$aUserData[0]['emergency_phone_1']}}</span><br/>
                    <label class="col-4 font-weight-bold" for="name">Noodnummer 2: </label>    <span class="col-4">{{$aUserData[0]['emergency_phone_2']}}</span>
                </div>



            </div>
            {{--
            <div class="button">
                <a class="nav-link" href="/profileEdit">Aanpassen</a>
            </div>
            --}}
        </form>
    </div>
@endsection