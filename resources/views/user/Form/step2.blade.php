@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/i18n/defaults-*.min.js"></script>
@endsection

@section('content')
<div class="container bg-white rounded shadow-sm">

    {{ Form::open(array('action' => 'RegisterController@step2', 'method' => 'post')) }}
    {{ csrf_field() }}

    <h2 class="my-2 pb-2 border-bottom border-dark">Persoonlijke gegevens</h2>
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
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Name info -->
    <div class="form-row ">
        <div class="form-group col-md-4">
            <label class="form-label">Achternaam*</label>
            {{ Form::text('txtNaam', $sEnteredLastName, ['required','id'=>'txtNaam','oninput'=>'this.className', 'class' => 'mb-2 form-control'])}}
        </div>
        <div class="form-group col-md-4">
            <label class="form-label">Voornaam*</label>
            {{ Form::text('txtVoornaam', $sEnteredFirstName, ['required','id'=>'txtVoornaam','oninput'=>'this.className', 'class' => 'mb-2 form-control'])}}
        </div>
        <div class="form-group col-md-4 ">
            <label class="form-label">Geslacht*</label>
            <br/>
            @foreach($aGenderOptions as $value => $Content)
                <div class="form-check form-check-inline mt-2">
                    @if($value == lcfirst($sCheckedGender))
                        {{ Form::radio('gender', $Content, true,['value'=> $value, 'class'=>'form-check-input'])}}
                    @else
                        {{ Form::radio('gender', $Content, null,['value'=> $value, 'class'=>'form-check-input'])}}
                    @endif
                    {{ Form::label('gender', $Content, ['class'=>'form-check-label']) }}
                </div>
            @endforeach
        </div>
    </div>

    <!-- Birth info -->

    <div class="form-row border-top pt-2">
        <div class="form-group col-md-4">
            <label class="form-label">Nationaliteit*</label>
            {{ Form::text('txtNationaliteit', $sEnteredNationality, ['required', 'id'=>'txtNationaliteit','oninput'=>'this.className', 'class' => 'mb-2 form-control'])}}
        </div>
        <div class="form-group col-md-4">
            <label class="form-label">Geboortedatum*</label>
            {{ Form::date('dateGeboorte', $sEnteredBirthDate, ['required', 'id'=>'dateGeboorte','oninput'=>'this.className','type'=>'date', 'class' => 'mb-2 form-control'])}}
        </div>
        <div class="form-group col-md-4">
            <label class="form-label">Geboorteplaats*</label>
            {{ Form::text('txtGeboorteplaats', $sEnteredBirthPlace, ['required', 'id'=>'txtGeboorteplaats','oninput'=>'this.className', 'class' => 'mb-2 form-control'])}}
        </div>
    </div>

    <!-- Adress info -->
    <div class="form-row border-top pt-2">
        <div class="form-group col-md-4">
            <label class="form-label">Adres*</label>
            {{ Form::text('txtAdres', $sEnteredAddress, ['required', 'id'=>'txtAdres','oninput'=>'this.className', 'class' => 'mb-2 form-control'])}}
        </div>
        <div class="form-group col-md-4">
            <label class="form-label">Woonplaats*</label>
            <button type="button" class="open btn-primary rounded btn-xs float-right  " data-toggle="modal" data-target="#zipPopup">
                <i class="fas fa-plus-circle "></i>
            </button>
            <select style="z-index: 1000" id="dropGemeentes" name="dropGemeentes" data-live-search="true" required class="mb-2 form-control selectpicker">
                <option value="0" disabled selected>Selecteer een woonplaats</option>
                @foreach($aCities as $oCity)
                    <option data-tokens="{{ $oCity->zip_code }} {{ $oCity->city }}" value={{ $oCity->zip_id }}> {{ $oCity->zip_code }} {{ $oCity->city }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-4">
            <label class="form-label">Land*</label>
            {{ Form::text('txtLand', $sEnteredCountry, ['required', 'id'=>'txtLand','oninput'=>'this.className', 'class' => 'mb-2 form-control'])}}
        </div>
    </div>
    <!-- Bank info -->
    <div class="form-row border-top pt-2">
        <div class="form-group col-md-6">
            <label class="form-label">Bankrekeningnummer (IBAN)*</label>
            {{ Form::text('txtBank', $sEnteredIban, ['required', 'id'=>'txtBank','oninput'=>'this.className', 'maxlength'=>34, 'class' => 'mb-2 form-control'])}}
        </div>
        <div class="form-group col-md-6">
            <label class="form-label">Bankidentificatiecode (BIC)*</label>
            {{ Form::text('txtBic', $sEnteredBic, ['required', 'id'=>'txtBIC','oninput'=>'this.className', 'class' => 'mb-2 form-control'])}}
        </div>
    </div>
    <a class = "btn btn-secondary form-control col-sm-2 mb-4 mt-2" href="/user/form/step-1">Vorige</a>
    {{ Form::submit('Volgende',['class' => 'btn btn-primary form-control col-sm-2 mb-4 mt-2 ']) }}
    {{ Form::close() }}

<!-- MODAL POPUP -->
    <div class="modal" id="zipPopup" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Organisators</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{Form::open(array('action' => 'AdminZipController@createZip', 'method' => 'post' ))}}
                    <div class="form-group col">
                        {{Form::label('zip_code', 'Postcode: ', ['class' => ''])}}
                        {{ Form::number('zip_code', null, array("class" => "form-control", "required", "min" => "1000", "max" => "9999", "oninvalid" => "this.setCustomValidity('Deze postcode is ongeldig')", "oninput" => "this.setCustomValidity('')", "placeholder" => "bv. 3660" )) }}
                    </div>
                    <div class="form-group col">
                        {{Form::label('city', 'Stad of Gemeente: ', ['class' => ''])}}
                        {{ Form::text('city', null, array("class" => "form-control", "required","maxlength" => "50", "oninvalid" => "this.setCustomValidity('Deze gemeente is ongeldig')", "oninput" => "this.setCustomValidity('')", "placeholder" => "bv: Opglabbeek")) }}
                    </div>
                </div>

                <div class="modal-footer">
                    {{Form::submit('Postcode Toevoegen', ['class' =>'btn btn-primary' ])}}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

    <script>$('#dropGemeentes').val({{ $iSelectedCityId }})</script>
@endsection