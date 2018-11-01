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
                            {{Form::text('trip-name')}}
                        </div>
                        <div class="form-group">
                            {{Form::label('trip-year','Jaar:')}}
                            {{Form::text('trip-year')}}
                        </div>
                        <div class="form-group">
                            {{Form::label('trip-is-active','Actief:')}}
                            {{Form::checkbox('trip-is-active','1')}}
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

    <p>Hier vind je alle reizen. Reizen die actief zijn daar kan men zich voor registreren.</p>

    <div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tripModal" data-trip-id="-1">
            Voeg reis toe
        </button>
        <table style="margin-top:5px">
            <thead>
                <tr>
                    <th class="admin-table">Naam</th>
                    <th class="admin-table">Jaar</th>
                    <th class="admin-table">Inscrijvingen actief</th>
                    <th class="admin-table"></th>
                </tr>
            </thead>

            <tbody>
            @foreach($aTripData as $oTrip)
                <tr>
                    <td class="admin-table">{{$oTrip->name}}</td>
                    <td class="admin-table">{{$oTrip->year}}</td>
                    @if($oTrip->is_active)
                        <td class="admin-table">Actief</td>
                    @else
                        <td class="admin-table">Non-actief</td>
                    @endif
                    <td class="admin-table"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tripModal" data-trip-id="{{$oTrip->trip_id}}" data-trip-name="{{$oTrip->name}}" data-trip-year="{{$oTrip->year}}" data-trip-active="{{$oTrip->is_active}}">Edit</button>
                        <!--<form method="get" action="/admin/trips/$oTrip->trip_id"><button type="submit" >Edit</button></form></td>-->
                </tr>
            @endForeach
            </tbody>
        </table>
    </div>
<script>
    $('#tripModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var tripName = button.data('trip-name');
        var tripYear = button.data('trip-year');
        var tripActive = button.data('trip-active');
        var tripId = button.data('trip-id');
        // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);

        modal.find('.modal-body #trip-name').val(tripName);
        modal.find('.modal-body #trip-year').val(tripYear);
        modal.find('.modal-body #trip-active').val(tripActive);
        modal.find('.modal-body #trip-id').val(tripId);
    })
</script>
@endsection