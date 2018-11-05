@extends('layouts.app')

@section('content')
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
            @endif
        @endforeach
    </div>
    <select name="selectedActiveTrip" class="travelChanged">
        @foreach ($aActiveTrips as $trip)
            <option value={{$trip->trip_id}}>{{$trip->name}}</option>
        @endforeach
    </select>
    <p>Organisators</p>
    <button type="button" class="open" data-toggle="modal" data-target="#organizerPopup">

    <i class="fas fa-plus-circle"></i>
    </button>
   <div>
        <table class="organizerTable">
            <thead>
                <tr>
                    <th>Voornaam</th>
                    <th>Achternaam</th>
                    <th>Actie</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

    <!-- MODAL POPUP -->
    <div class="modal" id="organizerPopup" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Organisators</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <table>
                        <thead>
                        <tr>
                            <th>
                              Naam
                            </th>
                            <th>
                              Toevoegen?
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($aOrganizers as $organizer)
                            <tr>
                            <td>
                                {{$organizer->first_name}} {{ $organizer->last_name}}
                            </td>
                            <td>

                            <input type="checkbox" class="organizersCheckbox" name="{{$organizer->traveller_id}}" value="{{$organizer->traveller_id}}">

                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="addActiveOrganizer()">Opslaan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ URL::asset('/js/activeTripOrganiser.js') }}"></script>
@endsection
