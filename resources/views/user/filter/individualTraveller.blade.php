@extends("layouts.app")
@section('style')
    <style>
        .individualUser_container{
            background: white;
            height: auto;
            width: 50%;
            font-weight: bold;
            color: #003469;
            overflow: hidden;
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
        }
        .individualUser_container form p{
            clear: both;
            padding: 19px;
        }
        .individualUser_container form{
            margin-bottom: 100px;
        }
        .individualUser_formContainer{
            display:flex;
            justify-content:center;
            align-items:center;
            padding-top: 20px;
        }
        .individualUser_leftForm{
            height: 300px;
            float:left;
        //border: 1px solid red;
        }
        .individualUser_rightForm{
            height: 300px;
        //border: 1px solid green;
            float: left;
        }
        .individualUser_formContainer label.field{
            text-align: left;
            width: 150px;
            float: left;
        }
        .individualUser_formContainer span{
            width: 250px;
            float: left;
            font-weight: normal;
        }


    </style>
@endsection
@section('content')


    <div class="individualUser_container">
        <form>
            <div class="individualUser_formContainer">
                <div class="individualUser_leftForm">
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

                <div class="individualUser_rightForm">
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