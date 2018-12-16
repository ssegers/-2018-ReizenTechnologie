@extends('layouts.app')

@section('content')
    <div class="modal fade" id="addHotelKamerPopup" tabindex="-1" role="dialog" aria-labelledby="addHotelKamerPopupLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addHotelKamerPopupLabel">Hotelkamer Toevoegen</h4>
                    {{Form::button('<span aria-hidden="true">&times;</span>',array('class' => 'close', 'type' => 'button','data-dismiss'=>'modal','aria-label'=>'close'))}}
                </div>
                {{ Form::open(array('action' => 'HotelRoomController@addHotelRoom', 'method' => 'post')) }}
                <div class="modal-body">
                    <div class="form-group">
                        {{Form::hidden('hotels_per_trip_id',$hotel_id)}}
                        {{Form::label('AantalPersonen','Aantal Personen:')}}
                        {{Form::number('AantalPersonen', null, array('class' => 'form-control','required' => 'required'))}}
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


    <div class="container">
        @if(session()->has('errormessage'))
            <div id="removeTimer" class="alert alert-warning">
                {{ session()->get('errormessage') }}
            </div>
        @endif
        @if(session()->has('succesmessage'))
            <div id="removeTimer" class="alert alert-success">
                {{ session()->get('succesmessage') }}
            </div>
        @endif
        <table class="table text-center">
            <tr><td colspan="2"><h1>{{$hotel_name}}</h1></td></tr>
            <tr>
                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addHotelKamerPopup">Voeg kamer toe</button></td>
                <td><a class="btn btn-primary" href="{{route('listhotelsOrganizer')}}">Terug</a></td>
            </tr>
            @foreach ($aRooms as $oRoom)
                <tr>
                    <td><h4>{{$aCurrentOccupation[$oRoom->rooms_hotel_trip_id]}}/{{$oRoom->size}}</h4></td>
                    <td>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse{{$oRoom->rooms_hotel_trip_id}}" aria-expanded="true" aria-controls="collapseExample">
                        Bekijk kamer
                    </button>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="collapse" id="collapse{{$oRoom->rooms_hotel_trip_id}}">
                            <div class="card card-body ">
                                <table class="table text-center">
                                    <?php $i=0 ?>
                                    @foreach($aTravellerPerRoom[$oRoom->rooms_hotel_trip_id] as $oTraveller)
                                            <tr><td>{{$oTraveller->first_name}} {{$oTraveller->last_name}}
                                                    @if($userTravellerId=='admin')
                                                        {{ Form::open(array('action' => 'HotelRoomController@leaveRoom', 'method' => 'post')) }}
                                                        {{Form::hidden('rooms_hotel_trip_id',$oRoom->rooms_hotel_trip_id)}}
                                                        {{Form::hidden('traveller_id',$oTraveller->traveller_id)}}
                                                        {{Form::button('Verlaat Kamer',array('class' => 'btn btn-secondary', 'type' => 'submit'))}}
                                                        {{Form::close()}}
                                                    @else
                                                        @if($oTraveller->traveller_id==$userTravellerId)
                                                            {{ Form::open(array('action' => 'HotelRoomController@leaveRoom', 'method' => 'post')) }}
                                                            {{Form::hidden('rooms_hotel_trip_id',$oRoom->rooms_hotel_trip_id)}}
                                                            {{Form::button('Verlaat Kamer',array('class' => 'btn btn-secondary', 'type' => 'submit'))}}
                                                            {{Form::close()}}
                                                        @endif
                                                    @endif

                                            </td></tr>
                                        <?php $i++ ?>
                                    @endforeach
                                    @for($i;$i<$oRoom->size;$i++)
                                        {{ Form::open(array('action' => 'HotelRoomController@chooseRoom', 'method' => 'post')) }}
                                            {{Form::hidden('hotels_per_trip_id',$hotel_id)}}
                                            {{Form::hidden('rooms_hotel_trip_id',$oRoom->rooms_hotel_trip_id)}}
                                            <tr><td>{{Form::button('Kies Kamer',array('class' => 'btn btn-secondary', 'type' => 'submit'))}}</td></tr>
                                            {{Form::close()}}
                                    @endfor
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <script>
        setTimeout(function(){
            if ($('#removeTimer').length > 0) {
                $('#removeTimer').remove();
            }
        }, 5000);
    </script>
@endsection