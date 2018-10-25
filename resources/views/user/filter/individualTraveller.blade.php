@extends("layouts.app")

@section('content')


    <div class="container border rounded margin-top-50 background-white">
        <form>
            <div class="row">
                <div class="col padding-10">
                    <p><label class="field" for="name">Naam: </label>            <span>{{$aUserData['last_name']}}</span></p>
                    <p><label class="field" for="name">Voornaam: </label>        <span>{{$aUserData["first_name"]}}</span></p>
                    <p><label class="field" for="name">Geslacht: </label>        <span>{{$aUserData['gender']}}</span></p>
                    <p><label class="field" for="name">Geboortedatum: </label>   <span>{{$aUserData['birthdate']}}</span></p>
                    <p><label class="field" for="name">Geboorteplaats: </label>  <span>{{$aUserData['birthplace']}}</span></p>
                    <p><label class="field" for="name">Nationaliteit: </label>   <span>{{$aUserData['nationality']}}</span></p>
                    <p><label class="field" for="name">Adres:  </label>          <span>{{$aUserData['address']}}</span></p>
                    <p><label class="field" for="name">Gemeente: </label>        <span>{{$aUserData['zip_town']}} {{$aUserData['zip_code']}}</span></p>
                    <p><label class="field" for="name">Land: </label>            <span>{{$aUserData['country']}}</span></p>
                </div>

                <div class="col padding-10">
                    <p><label class="field" for="name">Email: </label>           <span>{{$aUserData['email']}}</span></p>
                    <p><label class="field" for="name">Telefoon: </label>        <span>{{$aUserData['phone']}}</span></p>
                    <p><label class="field" for="name">Noodnummer 1: </label>    <span>{{$aUserData['emergency_phone_1']}}</span></p>
                    <p><label class="field" for="name">Noodnummer 2: </label>    <span>{{$aUserData['emergency_phone_2']}}</span></p>
                    <p><label class="field" for="name">Behandeling:</label>    @if($aUserData['medical_issue']) <span>Ja</span> @else <span>Nee</span> @endif</p>
                    <p><label class="field" for="name">Medische info: </label>   <span>{{$aUserData['medical_info']}}</span></p>
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