@extends('layouts.app')

@section('content')

    <div class="container">
        <!--Indien organisator -->
        <button>Voeg kamer toe</button>

        <!--Toon -->
        <table>
            @foreach ($aRooms as $oRoom)
                <tr>
                    <td>{{$aCurrentOccupation[$oRoom->rooms_hotel_trip_id]}}/{{$oRoom->size}}</td>
                    <td><form action="/user/listtravellers/{{$oRoom->rooms_hotel_trip_id}}.php" method="get"><button>Bekijk kamer</button></form></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection