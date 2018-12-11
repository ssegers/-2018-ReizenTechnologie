@extends('layouts.app')

@section('content')

<div class="container">
    <div class="modal fade" id="hotelinfoPopup" tabindex="-1" role="dialog" aria-labelledby="hotelinfoLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="hotelinfoLabel">Hotel Info</h4>
                    {{Form::button('<span aria-hidden="true">&times;</span>',array('class' => 'close', 'type' => 'button','data-dismiss'=>'modal','aria-label'=>'close'))}}
                </div>
                <div class="modal-body">
                    <table>
                        <tr><td><p id="hotel-name"></p></td></tr>
                        <tr><td><p id="hotel-address"></p></td></tr>
                        <tr><td><p id="hotel-phone"></p></td></tr>
                        <tr><td><p id="hotel-email"></p></td></tr>
                    </table>
                </div>
                <div class="modal-footer">
                    {{Form::button('Sluiten',array('class' => 'btn btn-default', 'type' => 'button','data-dismiss'=>'modal'))}}
                </div>
            </div>
        </div>
    </div>

    <table class="table text-center">
        <tr><td colspan="5"><h1>{{$aTrip->name}} {{$aTrip->year}}</h1></td></tr>
        <tr>
            <th></th>
            <th>Hotel Naam</th>
            <th>Startdatum</th>
            <th>Einddatum</th>
        </tr>
    @foreach ($aHotelsPerTrip as $oHotel)
            <tr>
                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#hotelinfoPopup" data-hotel-name="{{$oHotel->hotel_name}}" data-hotel-address="{{$oHotel->address}}" data-hotel-phone="{{$oHotel->phone}}" data-hotel-email="{{$oHotel->email}}" ><i class="fas fa-info-circle"></i></button></td>
                <td>{{ $oHotel->hotel_name }}</td>
                <td><?php echo $dd = date("d-m-Y", strtotime($oHotel->hotel_start_date)); ?></td>
                <td><?php echo $dd = date("d-m-Y", strtotime($oHotel->hotel_end_date)); ?></td>
                <td>
                    <form method="POST" action="/user/hotel/listrooms/{{$oHotel->hotels_per_trip_id}}/{{$oHotel->hotel_name}}">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                    {{ Form::submit('Bekijk kamers',array('class'=>"btn btn-primary")) }}
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>
<script>
    $('#hotelinfoPopup').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var name = button.data('hotel-name');
        var address = button.data('hotel-address');
        var phone = button.data('hotel-phone');
        var email = button.data('hotel-email');

        var modal = $(this);

        modal.find('.modal-body #hotel-name').text(name);
        modal.find('.modal-body #hotel-address').text(address);
        modal.find('.modal-body #hotel-phone').text(phone);
        modal.find('.modal-body #hotel-email').text(email);
    });
</script>
@endsection