@extends('layouts.admin')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    @if(session()->has('alert-message'))
        <div class="alert alert-danger">
            {{ session()->get('alert-message') }}
        </div>
    @endif

    <h1 class="my-5 text-center">Voeg hier een nieuwe postcode toe:</h1>
    {{Form::open(array('action' => 'AdminZipController@createZip', 'method' => 'post' ))}}
    <div class="form-group">
        {{Form::label('zip_code', 'Postcode: ', ['class' => ''])}}
        {{ Form::number('zip_code', null, array("class" => "form-control", "required", "min" => "1000", "max" => "9999", "oninvalid" => "this.setCustomValidity('Deze postcode is ongeldig')", "oninput" => "this.setCustomValidity('')", "placeholder" => "bv. 3660" )) }}
        <br/>
        {{Form::label('city', 'Stad of Gemeente: ', ['class' => ''])}}
        {{ Form::text('city', null, array("class" => "form-control", "required","maxlength" => "50", "oninvalid" => "this.setCustomValidity('Deze gemeente is ongeldig')", "oninput" => "this.setCustomValidity('')", "placeholder" => "bv: Opglabbeek")) }}
    </div>
    <div class="actions mb-3">
        {{Form::submit('Postcode Toevoegen', ['class' =>'btn btn-primary mr-4 p-2' ])}}
        {{Form::button('Annuleren', array("class" => "btn btn-danger p-2", "onclick" => "history.go(0)"))}}
    </div>
    {{Form::close()}}

    {{--
    Zoek bestaande postcodes:
    <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="paymentStatusTable" style="width: 510px;">
    --}}
    <table class="table" style="width: 510px;">
        <thead style="display: block;">
        <tr>
            <th scope="col" style="width: 150px;">Postcode</th>
            <th scope="col" style="width: 300px;">Gemeente</th>
            <th scope="col" style="width: 60px;"></th>
        </tr>
        </thead>
        <tbody style="display: block; height: 350px; overflow-y: auto; overflow-x: hidden;">
        @foreach($aZipData as $oZip)
            <tr>
                <td style="width: 150px;">{{$oZip->zip_code}}</td>
                <td style="width: 300px;">{{$oZip->city}}</td>
                <td style="width: 60px;">
                    <form method="POST" action="/admin/zip/{{$oZip->zip_id}}" onsubmit='return confirm("Bent u zeker dat u {{$oZip->zip_code}} {{$oZip->city}} wilt verwijderen?")'>
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-primary"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection