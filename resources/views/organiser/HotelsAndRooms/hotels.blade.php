@extends('layouts.app')

@section('content')

<div class="container">
    <!--Indien organisator-->
    {{ Form::open(array('id'=>'travelChanged','action' => 'HotelRoomController@getHotelsPerTripOrganizer', 'method' => 'post')) }}
        <select id="selectedActiveTrip" name="selectedActiveTrip" class="form-control-lg form-control mt-3 travelChanged">
            @foreach ($aActiveTrips as $trip)
                <option class="dropdown-item" value={{$trip->trip_id}}>{{$trip->name}} {{$trip->year}}</option>
            @endforeach
        </select>
    {{ Form::close() }}

        <select id="selectedHotel" name="selectedHotel" class="form-control-lg form-control mt-3 HotelChanged">
            @foreach ($aHotels as $aHotel)
                <option class="dropdown-item" value={{$aHotel->hotel_id}}>{{$aHotel->hotel_name}}</option>
            @endforeach
        </select>
    <div class="modal fade" id="hotelPopup" tabindex="-1" role="dialog" aria-labelledby="hotelPopupLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="hotelPopupLabel">Hotel Toevoegen</h4>
                    {{Form::button('<span aria-hidden="true">&times;</span>',array('class' => 'close', 'type' => 'button','data-dismiss'=>'modal','aria-label'=>'close'))}}
                </div>
                {{ Form::open(array('action' => 'HotelRoomController@createHotel', 'method' => 'post')) }}
                <div class="modal-body">
                    <div class="form-group">
                        {{Form::label('Hotelnaam','Hotelnaam:')}}
                        {{Form::text('Hotelnaam', null, array('class' => 'form-control','required' => 'required'))}}
                        {{Form::label('EmailHotel','Email Hotel:')}}
                        {{Form::text('EmailHotel', null, array('class' => 'form-control','required' => 'required'))}}
                        {{Form::label('Adres','Adres:')}}
                        {{Form::text('Adres', null, array('class' => 'form-control','required' => 'required'))}}
                        {{Form::label('Telnr','Telnr:')}}
                        {{Form::text('Telnr', null, array('class' => 'form-control','required' => 'required'))}}
                    </div>
                </div>
                <div class="modal-footer">
                    {{Form::button('Sluiten',array('class' => 'btn btn-default', 'type' => 'button','data-dismiss'=>'modal'))}}
                    {{Form::button('Opslaan',array('class' => 'btn btn-primary', 'type' => 'submit'))}}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="hoteltripPopup" tabindex="-1" role="dialog" aria-labelledby="hoteltripPopupLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="hoteltripPopupLabel">Hotel Toevoegen aan reis</h4>
                    {{Form::button('<span aria-hidden="true">&times;</span>',array('class' => 'close', 'type' => 'button','data-dismiss'=>'modal','aria-label'=>'close'))}}
                </div>
                {{ Form::open(array('action' => 'HotelRoomController@connectHotelToTrip', 'method' => 'post')) }}
                <div class="modal-body">
                    <div class="form-group">
                        {{Form::hidden('hotel_id',null,array('id'=>'hiddenHotelId'))}}
                        {{Form::hidden('trip_id',null,array('id'=>'hiddenTripId'))}}

                        {{Form::label('Startdatum','Startdatum:')}}
                        {{Form::date('Startdatum', null, array('class' => 'form-control','required' => 'required'))}}
                        {{Form::label('Einddatum','Einddatum:')}}
                        {{Form::date('Einddatum', null, array('class' => 'form-control','required' => 'required'))}}
                    </div>
                </div>
                <div class="modal-footer">
                    {{Form::button('Sluiten',array('class' => 'btn btn-default', 'type' => 'button','data-dismiss'=>'modal'))}}
                    {{Form::button('Opslaan',array('class' => 'btn btn-primary', 'type' => 'submit'))}}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="hotelinfoPopup" tabindex="-1" role="dialog" aria-labelledby="hotelinfoLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="hotelinfoLabel">Hotel Info</h4>
                    {{Form::button('<span aria-hidden="true">&times;</span>',array('class' => 'close', 'type' => 'button','data-dismiss'=>'modal','aria-label'=>'close'))}}
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr><td>Naam:</td><td><p id="hotel-name"></p></td></tr>
                        <tr><td>Adres:</td><td><p id="hotel-address"></p></td></tr>
                        <tr><td>Telnr:</td><td><p id="hotel-phone"></p></td></tr>
                        <tr><td>Emailadres:</td><td><p id="hotel-email"></p></td></tr>
                    </table>
                </div>
                <div class="modal-footer">
                    {{Form::button('Sluiten',array('class' => 'btn btn-default', 'type' => 'button','data-dismiss'=>'modal'))}}
                </div>
            </div>
        </div>
    </div>

    <table class="table text-center">
        <tr>
            <td colspan="3">
                <button type="button" class="m-5 p-3 float-right open btn btn-primary" data-toggle="modal" data-target="#hotelPopup">Nieuw hotel aanmaken</button>
            </td>
            <td colspan="2">
                <button id="connectButton" type="button" class="m-5 p-3 float-right open btn btn-primary" data-toggle="modal" data-target="#hoteltripPopup" onclick="connectHotelToTrip()">Hotel toevoegen aan reis</button>
            </td>
        </tr>
        <tr>
            <th></th>
            <th>Hotel Naam</th>
            <th>Startdatum</th>
            <th>Einddatum</th>
        </tr>
        @foreach ($aHotelsPerTrip as $oHotel)
            <tr>
                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#hotelinfoPopup" data-hotel-name="{{$oHotel->hotel_name}}" data-hotel-address="{{$oHotel->address}}" data-hotel-phone="{{$oHotel->phone}}" data-hotel-email="{{$oHotel->email}}" ><i class="fas fa-info-circle"></i></button></td>
                <td>{{ $oHotel->hotel_name }}</td>
                <td><?php echo $dd = date("d-m-Y", strtotime($oHotel->hotel_start_date)); ?></td>
                <td><?php echo $dd = date("d-m-Y", strtotime($oHotel->hotel_end_date)); ?></td>
                <td>
                    {{--{{ Form::open(array('action' => '/listrooms/'.$oHotel->hotels_per_trip_id, 'method' => 'post')) }}--}}
                    <form method="POST" action="/hotel/listrooms/{{$oHotel->hotels_per_trip_id}}/{{$oHotel->hotel_name}}">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                    {{ Form::submit('Bekijk kamers',array('class'=>"btn btn-primary")) }}
                    </form>
                </td>
                <td>
                    {{ Form::open(array('action' => 'HotelRoomController@deleteHotel', 'method' => 'post','onsubmit' => 'return ConfirmDelete()')) }}
                    {{ Form::hidden('hotels_per_trip_id', $oHotel->hotels_per_trip_id) }}
                    {{ Form::submit('Delete',array('class'=>"btn btn-primary")) }}
                    {{ Form::close()}}
                </td>

            </tr>
        @endforeach
    </table>
</div>
<script>
    $('#hotelinfoPopup').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var name = button.data('hotel-name');
        var address = button.data('hotel-address');
        var phone = button.data('hotel-phone');
        var email = button.data('hotel-email');

        var modal = $(this);

        modal.find('.modal-body #hotel-name').text(name);
        modal.find('.modal-body #hotel-address').text(address);
        modal.find('.modal-body #hotel-phone').text(phone);
        modal.find('.modal-body #hotel-email').text(email);
    });

    var selectTrip = document.getElementById('selectedActiveTrip');
    var selectHotel = document.getElementById('selectedHotel');
    var connectButton=document.getElementById('connectButton');

    selectTrip.addEventListener('change',function(){
        document.getElementById("travelChanged").submit();
    });


    var iTripId=<?php echo $iTripId ?>;
    var tripId=iTripId.trip_id
    selectTrip.value=tripId;
    connectButton.textContent="Hotel toevoegen aan "+selectTrip.options[selectTrip.selectedIndex].text+" reis";

    function connectHotelToTrip() {
        var hiddenTripField=document.getElementById('hiddenTripId')
        hiddenTripField.value=selectTrip.options[selectTrip.selectedIndex].value;
        var hiddenHotelField=document.getElementById('hiddenHotelId')
        hiddenHotelField.value=selectHotel.options[selectHotel.selectedIndex].value;
    }
    function ConfirmDelete(){
        return confirm('Bent u zeker? \nDe reizigers die al een plaats in het hotel gekozen hebben moeten hierna een andere plaats kiezen.');
    }
</script>
@endsection