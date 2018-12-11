@extends('layouts.app')

@section('content')
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
        <table class="table">
            <tr><td colspan="2"><h1>{{$hotel_name}}</h1></td></tr>
            <tr>
                <td><a class="btn btn-primary" href="{{route('listhotelsUser')}}">Terug</a></td>
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
                            <div class="card card-body">
                                <table>
                                    <?php $i=0 ?>
                                    @foreach($aTravellerPerRoom[$oRoom->rooms_hotel_trip_id] as $oTraveller)
                                            <tr><td>{{$oTraveller->first_name}} {{$oTraveller->last_name}}
                                        @if($oTraveller->traveller_id==$userTravellerId)
                                                {{ Form::open(array('action' => 'HotelRoomController@leaveRoom', 'method' => 'post')) }}
                                                {{Form::hidden('rooms_hotel_trip_id',$oRoom->rooms_hotel_trip_id)}}
                                                {{Form::button('Verlaat Kamer',array('class' => 'btn btn-secondary', 'type' => 'submit'))}}
                                                {{Form::close()}}
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