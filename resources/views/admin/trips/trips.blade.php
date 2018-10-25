@extends('layouts.admin')

@section('content')
    <!-- TODO
         Kleur toevoegen voor actief (groene tekst?)
         Knop achter iedere reis om de reis aan te passen
         Knop om een nieuwe reis toe te voegen
    -->


    <div class="modal fade" id="tripModal" tabindex="-1" role="dialog" aria-labelledby="tripModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="tripModalLabel">Reis aanmaken/editeren</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form method="post" action="/admin/trips/">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="trip-name" class="control-label">Reis:</label>
                            <input type="text" class="form-control" id="trip-name">
                        </div>
                        <div class="form-group">
                            <label for="trip-year" class="control-label">Jaar:</label>
                            <input type="text" class="form-control" id="trip-year"></input>
                        </div>
                        <div class="form-group">
                            <label for="trip-is-active" class="control-label">Actief:</label>
                            <input type="checkbox" class="form-control" id="trip-is-active"></input>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
                        <button type="submit" class="btn btn-primary">Opslaan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <p>Hier vind je alle reizen. Reizen die actief zijn daar kan men zich voor registreren</p>

    <div>
        <table>
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>Jaar</th>
                    <th>Inscrijvingen actief</th>
                    <th>Edit</th>
                </tr>
            </thead>

            <tbody>
            @foreach($aTripData as $oTrip)
                <tr>
                    <td>{{$oTrip->name}}</td>
                    <td>{{$oTrip->year}}</td>
                    @if($oTrip->is_active)
                        <td>Actief</td>
                    @else
                        <td>Non-actief</td>
                    @endif
                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tripModal" data-trip-id="{{$oTrip->trip_id}}" data-trip-name="{{$oTrip->name}}" data-trip-year="{{$oTrip->year}}" data-trip-active="{{$oTrip->is_active}}">Edit</button>
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
        console.log(modal);
        console.log(modal.parent());
        modal.find('.modal-body #trip-name').val(tripName);
        modal.find('.modal-body #trip-year').val(tripYear);
        modal.find('.modal-body #trip-active').val(tripActive);
    })
</script>

@endsection