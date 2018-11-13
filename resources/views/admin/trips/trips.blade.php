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
                            {{Form::text('trip-name', null, array('class' => 'form-control'))}}
                        </div>
                        <div class="form-group">
                            {{Form::label('trip-year','Jaar:')}}
                            {{Form::number('trip-year', null, array('class' => 'form-control'))}}
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
            <h1 class="my-5">Hier vind je alle reizen. Reizen die actief zijn daar kan men zich voor registreren.</h1>
            <button type="button" class="mb-5 p-3 float-right btn btn-primary" data-toggle="modal" data-target="#tripModal" data-trip-id="-1">
                Voeg een reis toe
            </button>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Naam</th>
                        <th scope="col">Jaar</th>
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
                        @if($oTrip->is_active)
                            <td >Actief</td>
                        @else
                            <td >Non-actief</td>
                        @endif
                        <td >{{$oTrip->contact_mail}}</td>
                        <td ><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tripModal" data-trip-id="{{$oTrip->trip_id}}" data-trip-name="{{$oTrip->name}}" data-trip-year="{{$oTrip->year}}" data-trip-active="{{$oTrip->is_active}}">Edit</button>
                            <!--<form method="get" action="/admin/trips/$oTrip->trip_id"><button type="submit" >Edit</button></form></td>-->
                    </tr>
                @endForeach
                </tbody>
            </table>
        </div>
    </div>
<script>
    $('#tripModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var tripName = button.data('trip-name');
        var tripYear = button.data('trip-year');
        var tripActive = button.data('trip-active');
        var tripMail = button.data('trip-mail');
        console.log(tripActive);
        var tripId = button.data('trip-id');
        // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);

        modal.find('.modal-body #trip-name').val(tripName);
        modal.find('.modal-body #trip-year').val(tripYear);
        modal.find('.modal-body #trip-active').val(tripActive);
        modal.find('.modal-body #trip-id').val(tripId);
        modal.find('.modal-body #trip-mail').val(tripMail);

        var active = $('#trip-is-active');
        if (tripActive == 1) {
            active.prop('checked', true);
        }
        else {
            active.prop('checked', false);
        }
    })
</script>
@endsection