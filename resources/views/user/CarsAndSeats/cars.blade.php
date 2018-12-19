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

        <table class="table text-center">
            <tr><td colspan="3"><h1>{{$aTrip->name}} {{$aTrip->year}}</h1></td></tr>
            <tr>
                <th>Auto Naam</th>
                <th>Resterende plaatsen</th>
                <th></th>
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
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <div class="collapse" id="collapse{{$oAuto->auto_id}}">
                            <div class="card card-body ">
                                <table class="table text-center">
                                    <?php $i=0 ?>
                                    @foreach($aTravellerPerAuto[$oAuto->auto_id] as $oTraveller)
                                        <tr><td>{{$oTraveller->first_name}} {{$oTraveller->last_name}}
                                                @if($oTraveller->traveller_id==$userTravellerId)
                                                    {{Form::open(array('action' => 'AutoController@leaveSeat', 'method' => 'post')) }}
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
                    <td></td>
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