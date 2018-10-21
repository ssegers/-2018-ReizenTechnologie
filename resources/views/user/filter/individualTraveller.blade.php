@extends("layouts.app")
@section('style')
    <style>
        /*
        body{
            background: #E9F3F8;
        }
        .container{
            background: #FFF;
            height: auto;
            font-weight: bold;
            color: #003469;
            overflow: hidden;
            margin-top: 20px;
        }
         */
        .formcontainer{
            display:flex;
            justify-content:center;
            align-items:center;
            padding-top: 20px;
        }
        .leftform{
            height: 500px;
            float:left;
        //border: 1px solid red;
        }
        .rightform{
            height: 500px;
        //border: 1px solid green;
            float: left;
        }
        .button{
        //border: 1px solid blue;
            display:flex;
            justify-content:center;
            align-items:center;
            margin: 5px;
        }
        .button a{
            background: #003469;
            font-weight: bold;
            display:flex;
            justify-content:center;
            align-items:center;
            color: #FFF;
            border: none;
            width: 275px;
            height: 70px;
            margin: 20px;
            text-transform: none;
        }
        label.field{
            text-align: left;
            width: 150px;
            float: left;
        }
        span{
            width: 250px;
            float: left;
            font-weight: normal;
        }
        form p{
            clear: both;
            padding: 19px;
        }
        form{
            margin-bottom: 100px;
        }

    </style>
@endsection
@section('content')


    <div class="container">
        <form>
            <div class="formcontainer">
                <div class="leftform">
                    <p><label class="field" for="name">Naam: </label>            <span>{{$traveller['last_name']}}</span></p>
                    <p><label class="field" for="name">Voornaam: </label>        <span>{{$traveller["first_name"]}}</span></p>
                    <p><label class="field" for="name">Geslacht: </label>        <span>{{$traveller['sex']}}</span></p>
                    <p><label class="field" for="name">Geboortedatum: </label>   <span>{{$traveller['birthdate']}}</span></p>
                    <p><label class="field" for="name">Geboorteplaats: </label>  <span>{{$traveller['birthplace']}}</span></p>
                    <p><label class="field" for="name">Nationaliteit: </label>   <span>{{$traveller['nationality']}}</span></p>
                    <p><label class="field" for="name">Adres:  </label>          <span>{{$traveller['address']}}</span></p>
                    <p><label class="field" for="name">Gemeente: </label>        <span>{{$traveller['zip_town']}} {{$traveller['zip_code']}}</span></p>
                    <p><label class="field" for="name">Land: </label>            <span>{{$traveller['country']}}</span></p>
                </div>

                <div class="rightform">
                    <p><label class="field" for="name">Email: </label>           <span>{{$traveller['email']}}</span></p>
                    <p><label class="field" for="name">Telefoon: </label>        <span>{{$traveller['phone']}}</span></p>
                    <p><label class="field" for="name">Noodnummer 1: </label>    <span>{{$traveller['emergency_phone_1']}}</span></p>
                    <p><label class="field" for="name">Noodnummer 2: </label>    <span>{{$traveller['emergency_phone_2']}}</span></p>
                    <p><label class="field" for="name">Behandeling:</label>    @if($traveller['medical_issue']) <span>Ja</span> @else <span>Nee</span> @endif</p>
                    <p><label class="field" for="name">Medische info: </label>   <span>{{$traveller['medical_info']}}</span></p>
                </div>
            </div>
            <div class="button">
                <a class="nav-link" href="/profileEdit">Aanpassen</a>
            </div>
        </form>
    </div>
@endsection