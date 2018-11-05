@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <div class="flash-message " id="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <p class="p-3 mt-3 alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h1 class="text-center mt-5">Koppel begeleiders aan actieve reizen.</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <select name="selectedActiveTrip" class="form-control-lg form-control mt-3 travelChanged">
                @foreach ($aActiveTrips as $trip)
                    <option class="dropdown-item" value={{$trip->trip_id}}>{{$trip->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h2 class="m-5">Organisators</h2>
        </div>
        <div class="col">
            <button type="button" class="m-5 p-3 float-right open btn btn-primary" data-toggle="modal" data-target="#organizerPopup">
                <i class="fas fa-plus-circle fa-2x"></i>
            </button>
        </div>
    </div>
   <div class="row">
       <div class="col">
        <table class="table organizerTable">
            <thead>
                <tr>
                    <th scope="col">Voornaam</th>
                    <th scope="col">Achternaam</th>
                    <th scope="col">Actie</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
       </div>
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

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">
                              Naam
                            </th>
                            <th scope="col">
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

                            <input type="checkbox" class="organizersCheckbox checkbox-lg"  name="{{$organizer->traveller_id}}" value="{{$organizer->traveller_id}}">

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
