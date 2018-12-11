@extends('layouts.admin')

@section('content')

    <style>
        .zips-table-wrapper{
        }

        .zipsTable > thead{
        }
        .zipsTableHeaderZip{
            width: 150px;
        }
        .zipsTableHeaderCity{
            width: 300px;
        }
        .zipsTableHeaderDelete{
            width: 60px;
        }
        .zipsTable > tbody{

        }
        .zipsTableRowZip{
            width: 150px;
        }
        .zipsTableRowCity{
            width: 300px;
        }
        .zipsTableRowDelete{
            width: 60px;
        }
    </style>

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

    <div class="zips-table-wrapper">
        <table class="table zipsTable" id="ZipsTable">
            <thead>
            <tr>
                <th class="zipsTableHeaderZip" scope="col">Postcode</th>
                <th class="zipsTableHeaderCity" scope="col">Gemeente</th>
                <th class="zipsTableHeaderDelete" scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($aZipData as $oZip)
                <tr>
                    <td class="zipsTableRowZip">{{$oZip->zip_code}}</td>
                    <td class="zipsTableRowCity">{{$oZip->city}}</td>
                    <td class="zipsTableRowDelete">
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
    </div>


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#ZipsTable').DataTable();
            $('.dataTables_length').addClass('bs-select');
        });
    </script>
@endsection