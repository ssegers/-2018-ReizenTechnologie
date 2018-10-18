@extends('layouts.app')

@section('content')
    <select name="selectedActiveTrip">
        @foreach ($aActiveTrips as $trip)
            <option value={{$trip->trip_id}}>{{$trip->name}}</option>
        @endforeach
    </select>
    <p>Organisators</p>
    <i class="fas fa-plus-circle"></i>
   <div>
        <table>
            <tr>
                @foreach($aCurrentMentors as $mentor)
                        <td>
                            {{$mentor->$name}}
                        </td>
                        <td>
                            <a href={{url('ActiveTripOrganisatorController@deleteOrganizer')}} id="{{$organizer->$id}}">
                                <i class="fas fa-minus-circle"></i></a>
                        </td>
                    @endif
                @endforeach
            </tr>
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
@endsection
