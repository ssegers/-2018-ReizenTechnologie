@extends('layouts.app')

@section('content')

    <select name="selectedActiveTrip" class="travelChanged">
        @foreach ($aActiveTrips as $trip)
            <option value={{$trip->trip_id}}>{{$trip->name}}</option>
        @endforeach
    </select>
    <p>Organisators</p>
    <i class="fas fa-plus-circle"></i>
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
    <div class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Organisators</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{--@foreach($aOrganizers as $organizer)--}}
                        {{--<p>--}}
                            {{--{{$organizer->$organizerName}}--}}
                        {{--</p>--}}
                        {{--<input type="checkbox" name="{{$organizer->$organizerId}}" value="{{$organizer->$organizerId}}">--}}
                    {{--@endforeach--}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Opslaan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ URL::asset('/js/activeTripOrganiser.js') }}"></script>
@endsection
