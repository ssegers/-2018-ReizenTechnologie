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

        {{ Form::open(array('id'=>'travelChanged','action' => 'AutoController@getAutosPerTripOrganizer', 'method' => 'post')) }}
        <select id="selectedActiveTrip" name="selectedActiveTrip" class="form-control-lg form-control mt-3 travelChanged">
            @foreach ($aActiveTrips as $trip)
                <option class="dropdown-item" value={{$trip->trip_id}}>{{$trip->name}} {{$trip->year}}</option>
            @endforeach
        </select>
        {{ Form::close() }}

        <div class="modal fade" id="autoPopup" tabindex="-1" role="dialog" aria-labelledby="autoPopupLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="hotelPopupLabel">Auto Toevoegen</h4>
                        {{Form::button('<span aria-hidden="true">&times;</span>',array('class' => 'close', 'type' => 'button','data-dismiss'=>'modal','aria-label'=>'close'))}}
                    </div>
                    {{ Form::open(array('action' => 'AutoController@createAuto', 'method' => 'post')) }}
                    <div class="modal-body">
                        <div class="form-group">
                            {{Form::hidden('TripId',null,array('id'=>'hiddenTripId'))}}
                            {{Form::label('AutoNaam','Auto naam:')}}
                            {{Form::text('AutoNaam', null, array('class' => 'form-control','required' => 'required'))}}
                            {{Form::label('AutoSize','Auto plaatsen:')}}
                            {{Form::text('AutoSize', null, array('class' => 'form-control','required' => 'required'))}}
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
        <table class="table text-center">
            <tr>
                <td colspan="4">
                    <button type="button" class="m-5 p-3 float-right open btn btn-primary" data-toggle="modal" data-target="#autoPopup" onclick="connectAutoToTrip()">Nieuwe Auto aanmaken</button>
                </td>
            </tr>
            <tr>
                <th>Auto Naam</th>
                <th>Resterende plaatsen</th>
                <th colspan="2"></th>
            </tr>
            @foreach ($aAutosPerTrip as $oAuto)
                <tr>
                    <td>{{ $oAuto->auto_name }}</td>
                    <td>{{$aCurrentOccupation[$oAuto->auto_id]}}/{{$oAuto->size}}</td>
                    <td>
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse{{$oAuto->auto_id}}" aria-expanded="true" aria-controls="collapseExample">
                            Bekijk Auto
                        </button>
                    </td>
                    <td>
                        {{ Form::open(array('action' => 'AutoController@deleteAuto', 'method' => 'post','onsubmit' => 'return ConfirmDelete()')) }}
                        {{ Form::hidden('auto_id', $oAuto->auto_id) }}
                        {{ Form::hidden('autos_per_trip_id', $oAuto->autos_per_trip_id) }}
                        {{ Form::submit('Delete',array('class'=>"btn btn-primary")) }}
                        {{ Form::close()}}
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <div class="collapse" id="collapse{{$oAuto->auto_id}}">
                            <div class="card card-body ">
                                <table class="table text-center">
                                    <?php $i=0 ?>
                                    @foreach($aTravellerPerAuto[$oAuto->auto_id] as $oTraveller)
                                        <tr><td>{{$oTraveller->first_name}} {{$oTraveller->last_name}}
                                                @if($oTraveller->traveller_id==$userTravellerId)
                                                    {{ Form::open(array('action' => 'AutoController@leaveSeat', 'method' => 'post')) }}
                                                    {{Form::button('Verlaat Auto',array('class' => 'btn btn-secondary', 'type' => 'submit'))}}
                                                    {{Form::close()}}
                                                @endif
                                            </td></tr>
                                        <?php $i++ ?>
                                    @endforeach
                                    @for($i;$i<$oAuto->size;$i++)
                                        {{ Form::open(array('action' => 'AutoController@chooseSeat', 'method' => 'post')) }}
                                        {{Form::hidden('autos_per_trip_id',$oAuto->autos_per_trip_id)}}
                                            <tr><td>{{Form::button('Kies Auto',array('class' => 'btn btn-secondary', 'type' => 'submit'))}}</td></tr>
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
        var selectTrip = document.getElementById('selectedActiveTrip');
        var iTripId=<?php echo $iTripId ?>;
        var tripId=iTripId.trip_id

        selectTrip.addEventListener('change',function(){
            document.getElementById("travelChanged").submit();
        });

        selectTrip.value=tripId;
        function connectAutoToTrip() {
            var hiddenTripField=document.getElementById('hiddenTripId')
            hiddenTripField.value=selectTrip.options[selectTrip.selectedIndex].value;
        }
        function ConfirmDelete(){
            return confirm('Are you sure?');
        }
        setTimeout(function(){
            if ($('#removeTimer').length > 0) {
                $('#removeTimer').remove();
            }
        }, 5000);
    </script>
@endsection