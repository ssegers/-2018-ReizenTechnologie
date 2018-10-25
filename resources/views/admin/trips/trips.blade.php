@extends('layouts.admin')

@section('content')
    <!-- TODO
         Kleur toevoegen voor actief (groene tekst?)
         Knop achter iedere reis om de reis aan te passen
         Knop om een nieuwe reis toe te voegen
    -->
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
                    <td><form method="get" action="/admin/trips/{{$oTrip->trip_id}}"><button type="submit" >Edit</button></form></td>
                </tr>
            @endForeach
            </tbody>
        </table>
    </div>
