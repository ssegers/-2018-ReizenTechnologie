@extends('layouts.app')

@section('content')

<div>
    <!--Indien organisator
        Toon pop-up via bootstrap modal
    -->
    <button>Voeg een hotel toe</button>

    <!--Altijd-->
    <table>
        @foreach ($aHotels as $oHotel)
            <tr>
                <td>{{ $oHotel->hotel_name }}</td>
                <td><form action="/listrooms/{{$oHotel->hotels_per_trip_id}}.php" method="get"><button>Bekijk kamers</button></form></td>
            </tr>
        @endforeach
    </table>
</div>
@endsection