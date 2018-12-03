@extends('layouts.app')

@section('content')
    <!--Toon in een tabel alle reizigers (voornaam/naam) in een kamer
        Indien deze niet vol is, toon een knop om de ingelogde reiziger toe te voegen aan deze kamer
    -->
<table>
    @for($i=0;i<=$aantalKamers;$i++)
        @for($i;i<=$countNotAvailableRooms;$i++)
        <tr>
            <td>
                {{$akamers[$i]}}
            </td>
        </tr>
        @endfor
        <button>Kies kamer</button>
    @endfor
</table>
@endsection