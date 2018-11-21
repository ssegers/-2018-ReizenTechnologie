@extends('layouts.app')

@section('content')
<div class="container bg-white rounded shadow-sm">

    {{ Form::open(array('action' => 'RegisterController@step2', 'method' => 'post')) }}
    {{ csrf_field() }}

    <h2 class="my-2 pb-2 border-bottom border-dark">Persoonlijke gegevens</h2>
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
            <label class="form-label">Naam*</label>
            {{ Form::text('txtNaam', '', ['required','id'=>'txtNaam','oninput'=>'this.className', 'class' => 'mb-2 form-control'])}}
        </div>
        <div class="form-group col-md-4">
            <label class="form-label">Voornaam*</label>
            {{ Form::text('txtVoornaam', '', ['required','id'=>'txtVoornaam','oninput'=>'this.className', 'class' => 'mb-2 form-control'])}}
        </div>
        <div class="form-group col-md-4 ">
            <label class="form-label">Geslacht*</label>
            <br/>
            <div class="form-check form-check-inline mt-2">
                {{ Form::radio('gender', 'Man', '', ['id'=>'radioGeslachtMan','oninput'=>'this.className', 'value'=> 'man', 'class'=>'form-check-input'])}}
                {{ Form::label('radioGeslachtMan', 'Man',['class'=>'form-check-label']) }}
            </div>
            <div class="form-check form-check-inline">
                {{ Form::radio('gender', 'Vrouw', '', ['id'=>'radioGeslachtVrouw','oninput'=>'this.className', 'value'=> 'vrouw', 'class'=>'form-check-input'])}}
                {{ Form::label('radioGeslachtVrouw', 'Vrouw',['class'=>'form-check-label']) }}
            </div>
            <div class="form-check form-check-inline">
                {{ Form::radio('gender', 'Andere', '', ['id'=>'radioGeslachtAndere','oninput'=>'this.className', 'value'=> 'andere', 'class'=>'form-check-input'])}}
                {{ Form::label('radioGeslachtAndere', 'Andere',['class'=>'  form-check-label']) }}
            </div>
        </div>
    </div>



    <!-- Birth info -->

    <div class="form-row border-top pt-2">
        <div class="form-group col-md-4">
            <label class="form-label">Nationaliteit*</label>
            {{ Form::text('txtNationaliteit', '', ['required', 'id'=>'txtNationaliteit','oninput'=>'this.className', 'class' => 'mb-2 form-control'])}}
        </div>
        <div class="form-group col-md-4">
            <label class="form-label">Geboortedatum*</label>
            {{ Form::date('dateGeboorte', '', ['required', 'id'=>'dateGeboorte','oninput'=>'this.className','type'=>'date', 'class' => 'mb-2 form-control'])}}
        </div>
        <div class="form-group col-md-4">
            <label class="form-label">Geboorteplaats*</label>
            {{ Form::text('txtGeboorteplaats', '', ['required', 'id'=>'txtGeboorteplaats','oninput'=>'this.className', 'class' => 'mb-2 form-control'])}}
        </div>
    </div>

    <!-- Adress info -->
    <div class="form-row border-top pt-2">
        <div class="form-group col-md-4">
            <label class="form-label">Adres*</label>
            {{ Form::text('txtAdres', '', ['required', 'id'=>'txtAdres','oninput'=>'this.className', 'class' => 'mb-2 form-control'])}}
        </div>
        <div class="form-group col-md-4">
            <label class="form-label">Woonplaats*</label>
            <select id="dropGemeentes" name="dropGemeentes" required class="mb-2 form-control">
            @foreach($aZips as $zipKey => $zipValue)
                    <optgroup label="{{ $zipKey }}">
                    @foreach($zipValue as $city)
                        <option value={{ $city }}> {{ $city }}</option>
                    @endforeach
                    </optgroup>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label class="form-label">Land*</label>
            {{ Form::text('txtLand', '', ['required', 'id'=>'txtLand','oninput'=>'this.className', 'class' => 'mb-2 form-control'])}}
        </div>
    </div>
    <!-- Bank info -->
    <div class="form-row border-top pt-2">
        <div class="form-group col-md-12">
            <label class="form-label">Bankrekeningnummer (IBAN)*</label>
            {{ Form::text('txtBank', '', ['required', 'id'=>'txtBank','oninput'=>'this.className', 'maxlength'=>34, 'class' => 'mb-2 form-control'])}}

        </div>

    </div>

    <a class = "btn btn-secondary form-control col-sm-2 mb-4 mt-2" href="/user/form/step-1">Vorige</a>
    {{ Form::submit('Volgende',['class' => 'btn btn-primary form-control col-sm-2 mb-4 mt-2 ']) }}
    {{ Form::close() }}
</div>

@endsection