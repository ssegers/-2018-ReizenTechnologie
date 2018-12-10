@extends('layouts.app')

@section('content')

<div class="container">
    <!--Indien organisator-->
    {{ Form::open(array('id'=>'travelChanged','action' => 'HotelRoomController@getHotelsPerTrip', 'method' => 'post')) }}
        <select id="selectedActiveTrip" name="selectedActiveTrip" class="form-control-lg form-control mt-3 travelChanged">
            @foreach ($aActiveTrips as $trip)
                <option class="dropdown-item" value={{$trip->trip_id}}>{{$trip->name}}</option>
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
                        {{--{{Form::label('Startdatum','Startdatum:')}}--}}
                        {{--{{Form::date('Startdatum', null, array('class' => 'form-control','required' => 'required'))}}--}}
                        {{--{{Form::label('Einddatum','Einddatum:')}}--}}
                        {{--{{Form::date('Einddatum', null, array('class' => 'form-control','required' => 'required'))}}--}}
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
                    <table>
                        <tr><td><p id="hotel-name"></p></td></tr>
                        <tr><td><p id="hotel-address"></p></td></tr>
                        <tr><td><p id="hotel-phone"></p></td></tr>
                        <tr><td><p id="hotel-email"></p></td></tr>
                    </table>
                </div>
                <div class="modal-footer">
                    {{Form::button('Sluiten',array('class' => 'btn btn-default', 'type' => 'button','data-dismiss'=>'modal'))}}
                </div>
            </div>
        </div>
    </div>


    <button type="button" class="m-5 p-3 float-right open btn btn-primary" data-toggle="modal" data-target="#hotelPopup">Hotel toevoegen</button>
    <button type="button" class="m-5 p-3 float-right open btn btn-primary" data-toggle="modal" data-target="#hoteltripPopup" onclick="connectHotelToTrip()">Hotel toevoegen aan reis</button>

    <!--Altijd-->
    <table class="table">
        @foreach ($aHotelsPerTrip as $oHotel)
            <tr>
                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#hotelinfoPopup" data-hotel-name="{{$oHotel->hotel_name}}" data-hotel-address="{{$oHotel->address}}" data-hotel-phone="{{$oHotel->phone}}" data-hotel-email="{{$oHotel->email}}" ><i class="fas fa-info-circle"></i></button></td>
                <td>{{ $oHotel->hotel_name }}</td>
                {{--<td>{{ $oHotel->hotel_amount_of_rooms }}</td>--}}
                <td>{{ $oHotel->hotel_start_date }}</td>
                <td>{{ $oHotel->hotel_end_date }}</td>
                <td><button class="btn btn-primary">Bekijk kamers</button></td>
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

    selectTrip.addEventListener('change',function(){
        document.getElementById("travelChanged").submit();
    });


    var iTripId=<?php echo $iTripId ?>;
    var tripId=iTripId.trip_id
    selectTrip.value=tripId;

    function connectHotelToTrip() {
        var hiddenTripField=document.getElementById('hiddenTripId')
        hiddenTripField.value=selectTrip.options[selectTrip.selectedIndex].value;
        var hiddenHotelField=document.getElementById('hiddenHotelId')
        hiddenHotelField.value=selectHotel.options[selectHotel.selectedIndex].value;
    }
    function ConfirmDelete(){
        return confirm('Are you sure?');
    }
</script>
@endsection