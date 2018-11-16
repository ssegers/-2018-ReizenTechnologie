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
    <!--
    <h2 class="tabTitle">Persoonlijke gegevens:</h2>
    {{--<p><label class="formLabel">Naam</label>{{ Form::text('txtNaam', '', ['id'=>'txtNaam','oninput'=>'this.className'])}}</p>--}}
    {{--<p><label class="formLabel">Voornaam</label>{{ Form::text('txtVoornaam', '', ['id'=>'txtVoornaam','oninput'=>'this.className'])}}</p>--}}
    {{--<p><label class="formLabel">Geslacht</label>--}}
        {{--{{ Form::radio('gender', 'Man', ['id'=>'radioGeslacht','oninput'=>'this.className'])}}Man--}}
        {{--{{ Form::radio('gender', 'Vrouw', ['id'=>'radioGeslacht','oninput'=>'this.className'])}}Vrouw--}}
        {{--{{ Form::radio('gender', 'Andere', ['id'=>'radioGeslacht','oninput'=>'this.className'])}}Andere--}}
    {{--</p>--}}
    {{--<p><label class="formLabel">Nationaliteit</label>{{ Form::text('txtNationaliteit', '', ['id'=>'txtNationaliteit','oninput'=>'this.className'])}}</p>--}}
    {{--<p><label class="formLabel">Geboortedatum</label>{{ Form::date('dateGeboorte', '', ['id'=>'dateGeboorte','oninput'=>'this.className','type'=>'date'])}}</p>--}}
    {{--<p><label class="formLabel">Geboorteplaats</label>{{ Form::text('txtGeboorteplaats', '', ['id'=>'txtGeboorteplaats','oninput'=>'this.className'])}}</p>--}}
    {{--<p><label class="formLabel">Adres</label>{{ Form::text('txtAdres', '', ['id'=>'txtAdres','oninput'=>'this.className'])}}</p>--}}
{{----}}
    {{--<p><label class="formLabel">Woonplaats</label>{{ Form::text('dropGemeente', '', ['id'=>'dropGemeente','oninput'=>'this.className'])}}</p>--}}
    {{--<p><label class="formLabel">Land</label>{{ Form::text('txtLand', '', ['id'=>'txtLand','oninput'=>'this.className'])}}</p>--}}
    {{--<p><label class="formLabel">Bankrekeningnummer (IBAN)</label>{{ Form::text('txtBank', '', ['id'=>'txtBank','oninput'=>'this.className', 'maxlength'=>34])}}</p>--}}
    -->

    <!-- Name info -->
    <div class="form-row ">
        <div class="form-group col-md-4">
            <label class="form-label">Naam</label>
            {{ Form::text('txtNaam', '', ['required','id'=>'txtNaam','oninput'=>'this.className', 'class' => 'mb-2 form-control'])}}
        </div>
        <div class="form-group col-md-4">
            <label class="form-label">Voornaam</label>
            {{ Form::text('txtVoornaam', '', ['required','id'=>'txtVoornaam','oninput'=>'this.className', 'class' => 'mb-2 form-control'])}}
        </div>
        <div class="form-group col-md-4 ">
            <label class="form-label">Geslacht</label>
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
            <label class="form-label">Nationaliteit</label>
            {{ Form::text('txtNationaliteit', '', ['id'=>'txtNationaliteit','oninput'=>'this.className', 'class' => 'mb-2 form-control'])}}
        </div>
        <div class="form-group col-md-4">
            <label class="form-label">Geboortedatum</label>
            {{ Form::date('dateGeboorte', '', ['id'=>'dateGeboorte','oninput'=>'this.className','type'=>'date', 'class' => 'mb-2 form-control'])}}
        </div>
        <div class="form-group col-md-4">
            <label class="form-label">Geboorteplaats</label>
            {{ Form::text('txtGeboorteplaats', '', ['id'=>'txtGeboorteplaats','oninput'=>'this.className', 'class' => 'mb-2 form-control'])}}
        </div>
    </div>

    <!-- Adress info -->
    <div class="form-row border-top pt-2">
        <div class="form-group col-md-4">
            <label class="form-label">Adres</label>
            {{ Form::text('txtAdres', '', ['id'=>'txtAdres','oninput'=>'this.className', 'class' => 'mb-2 form-control'])}}
        </div>
        <div class="form-group col-md-4">
            <label class="form-label">Woonplaats</label>
            {{ Form::select('dropGemeentes', $aZips, null ,['id'=>'dropGemeentes','oninput'=>'this.className', 'class' => 'mb-2 form-control '])}}
            {{--{{ Form::text('dropGemeente', '', ['id'=>'dropGemeente','oninput'=>'this.className', 'class' => 'mb-2 form-control'])}}--}}
        </div>
        <div class="form-group col-md-4">
            <label class="form-label">Land</label>
            {{ Form::text('txtLand', '', ['id'=>'txtLand','oninput'=>'this.className', 'class' => 'mb-2 form-control'])}}
        </div>
    </div>
    <!-- Bank info -->
    <div class="form-row border-top pt-2">
        <div class="form-group col-md-12">
            <label class="form-label">Bankrekeningnummer (IBAN)</label>
            {{ Form::text('txtBank', '', ['id'=>'txtBank','oninput'=>'this.className', 'maxlength'=>34, 'class' => 'mb-2 form-control'])}}

        </div>

    </div>

    <a class = "btn btn-secondary form-control col-sm-2 mb-4 mt-2" href="{{url()->previous()}}">Vorige</a>
    {{ Form::submit('Volgende',['class' => 'btn btn-primary form-control col-sm-2 mb-4 mt-2 ']) }}
    {{ Form::close() }}
</div>

@endsection