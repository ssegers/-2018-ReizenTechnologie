@extends('layouts.app')

@section('content')

<div class="container">
    <!--Indien organisator
        Toon pop-up via bootstrap modal
    -->
    {{--<select name="selectedActiveTrip" class="form-control-lg form-control mt-3 travelChanged">--}}
        {{--@foreach ($aActiveTrips as $trip)--}}
            {{--<option class="dropdown-item" value={{$trip->trip_id}}>{{$trip->name}}</option>--}}
        {{--@endforeach--}}
    {{--</select>--}}

    {{--<select name="selectedHotel" class="form-control-lg form-control mt-3 hotelChanged">--}}
        {{--<option value="" selected disabled hidden>Kies een hotel</option>--}}
    {{--</select>--}}
    {{--<button type="button" class="m-5 p-3 float-right open btn btn-primary" data-toggle="modal" data-target="#hotelPopup">--}}
        {{--<i class="fas fa-plus-circle fa-2x"></i>--}}
    {{--</button>--}}
    {{--<button type="button" class="m-5 p-3 float-right open btn btn-primary">Voeg toe</button>--}}
    <!--Altijd-->
    <table>
        @foreach ($aHotels as $oHotel)
            <tr>
                <td><button><i class="fas fa-info-circle"></i></button></td>
                <td>{{ $oHotel->hotel_id }}</td>
                {{--<td>{{ $oHotel->hotel_amount_of_rooms }}</td>--}}
                {{--<td>{{ $oHotel->hotel_start_date }}</td>--}}
                {{--<td>{{ $oHotel->hotel_end_date }}</td>--}}
                <td><button>Bekijk kamers</button></td>
                <td><button>Verwijder hotel uit tabel</button></td>
            </tr>
        @endforeach
    </table>
</div>
@endsection