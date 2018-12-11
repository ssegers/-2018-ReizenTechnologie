@extends('layouts.admin')

@section('content')
    <div class="modal fade" id="tripModal" tabindex="-1" role="dialog" aria-labelledby="tripModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="tripModalLabel">Reis aanmaken/editeren</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                {{ Form::open(array('action' => 'AdminTripController@UpdateOrCreateTrip', 'method' => 'post')) }}
                    <div class="modal-body">
                        <div class="form-group">
                            {{Form::label('trip-name','Naam:')}}
                            {{Form::text('trip-name', null, array('class' => 'form-control', 'required'))}}
                        </div>
                        <div class="form-group">
                            {{Form::label('trip-year','Jaar:')}}
                            {{Form::number('trip-year', null, array('class' => 'form-control', 'required'))}}
                        </div>
                        <div class="form-group">
                            {{Form::label('trip-price','Prijs in Euro:')}}
                            {{Form::number('trip-price', null, array('class' => 'form-control', 'required'))}}
                        </div>
                        <div class="form-group">
                            {{Form::label('trip-is-active','Actief:')}}
                            <input type="checkbox" class="checkbox-lg m-3" name="trip-is-active" value="1" id="trip-is-active"/>
                            {{--{{Form::checkbox('trip-is-active','1' )}}--}}
                        </div>
                        <div class="form-group">
                            {{Form::label('trip-mail','Mail contactpersoon:')}}
                            {{Form::text('trip-mail', null, array('class' => 'form-control'))}}
                        </div>
                            {{ Form::hidden('trip-id','trip-id',array('id'=>'trip-id')) }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
                        <button type="submit" class="btn btn-primary">Opslaan</button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

    <div class="row" style="margin-left: 2px; margin-top: 2px;">
        <div class="col">
            <h1 class="my-5">Beheer reizen</h1>
            <p>Hier vind je alle reizen. Reizen die actief zijn daar kan men zich voor registreren.</p>
            <button type="button" class="mb-5 p-3 float-right btn btn-primary" data-toggle="modal" data-target="#tripModal" data-trip-id="-1">
                Voeg een reis toe
            </button>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Naam</th>
                        <th scope="col">Jaar</th>
                        <th scope="col">Prijs</th>
                        <th scope="col">Inscrijvingen actief</th>
                        <th scope="col">Mail contactpersoon</th>
                        <th scope="col">Bewerken</th>
                        
                    </tr>
                </thead>

                <tbody>
                @foreach($aTripData as $oTrip)
                    <tr>
                        <td >{{$oTrip->name}}</td>
                        <td >{{$oTrip->year}}</td>
                        <td>&euro; {{$oTrip->price}}</td>
                        @if($oTrip->is_active)
                            <td >Actief</td>
                        @else
                            <td >Non-actief</td>
                        @endif
                        <td >{{$oTrip->contact_mail}}</td>
                        <td ><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tripModal" data-trip-id="{{$oTrip->trip_id}}">Edit</button>
                            <!--<form method="get" action="/admin/trips/$oTrip->trip_id"><button type="submit" >Edit</button></form></td>-->
                    </tr>
                @endForeach
                </tbody>
            </table>
        </div>
    </div>
<script src="{{ URL::asset('js/adminTrip.js') }}"></script>
@endsection