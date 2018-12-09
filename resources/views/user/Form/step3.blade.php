@extends('layouts.app')

@section('content')

<div class="container bg-white rounded shadow-sm">
    <h2 class="my-2 pb-2 border-bottom border-dark">Contact gegevens</h2>
    {{ Form::open(array('action' => 'RegisterController@step3', 'method' => 'post')) }}
    {{ csrf_field() }}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-row border-bottom pt-2">
        <div class="form-group col-md-8">
            <label class="form-label">E-mail adres (van de school)*</label>

            @if($user['role'] == "Student")
            {{ Form::text('txtEmail', $traveller['first_name'] . '.' . str_replace(' ', '', $traveller['last_name']) . '@student.ucll.be', ['required', 'readonly','id'=>'txtEmail','oninput'=>'this.className', 'class' => 'mb-2 form-control '])}}
            @else
                {{ Form::text('txtEmail', $traveller['first_name'] . '.' . str_replace(' ', '', $traveller['last_name']) . '@ucll.be', ['required', 'readonly', 'id'=>'txtEmail','oninput'=>'this.className', 'class' => 'mb-2 form-control '])}}
            @endif
        </div>
        <div class="form-group col-md-4">
            <label class="form-label">GSM-nummer*</label>
            @if(isset($traveller['phone']))
            {{ Form::text('txtGsm', $traveller['phone'], ['required', 'id'=>'txtGsm','oninput'=>'this.className', 'class' => 'mb-2 form-control '])}}
            @else
            {{ Form::text('txtGsm', '', ['required', 'id'=>'txtGsm','oninput'=>'this.className', 'class' => 'mb-2 form-control '])}}
            @endif
        </div>
    </div>
    <div class="form-row border-bottom pt-2">
        <div class="form-group col-md-6">
            <label class="form-label">Noodnummer 1*</label>
            @if(isset($traveller['emergency_phone_1']))
            {{ Form::text('txtNoodnummer1', $traveller['emergency_phone_1'], ['required', 'id'=>'txtNoodnummer1','oninput'=>'this.className', 'class' => 'mb-2 form-control '])}}
            @else
            {{ Form::text('txtNoodnummer1', '', ['required', 'id'=>'txtNoodnummer1','oninput'=>'this.className', 'class' => 'mb-2 form-control '])}}
            @endif
        </div>

        <div class="form-group col-md-6">
            <label class="form-label">Noodnummer 2</label>
            @if(isset($traveller['emergency_phone_2']))
            {{ Form::text('txtNoodnummer2', $traveller['emergency_phone_2'], ['id'=>'txtNoodnummer2','oninput'=>'this.className', 'class' => 'mb-2 form-control '])}}
            @else
            {{ Form::text('txtNoodnummer2', '', ['id'=>'txtNoodnummer2','oninput'=>'this.className', 'class' => 'mb-2 form-control '])}}
            @endif
        </div>
    </div>
    <h2 class="my-2 pb-2 border-bottom border-dark">Medische gegevens</h2>
    <div class="form-row border-bottom pt-2">
        <div class="form-group col-md-12">
        <label class="form-label">Heeft u een operatie gehad in het afgelopen jaar of andere medische aandoening? (Allergie, ziekte, ...)</label><br>
        <div>
            @if($traveller['medical_issue'] == '1')
            {{ Form::radio('radioMedisch', '1', true,['id'=>'radioMedisch','oninput'=>'this.className'])}}Ja
            @else
            {{ Form::radio('radioMedisch', '1', ['id'=>'radioMedisch','oninput'=>'this.className'])}}Ja
            @endif
            @if($traveller['medical_issue'] == '0')
            {{ Form::radio('radioMedisch', '0', true, ['id'=>'radioMedisch','oninput'=>'this.className'])}}Nee
            @else
            {{ Form::radio('radioMedisch', '0', ['id'=>'radioMedisch','oninput'=>'this.className'])}}Nee
            @endif
        </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
        <label class="formLabel">Wat houden deze in?</label>
            <br/>
            @if(isset($traveller['medical_info']))
            {{ Form::textarea('txtMedisch', $traveller['medical_info'], ['id'=>'txtMedisch','oninput'=>'this.className','placeholder'=>'Niet verplicht'])}}
            @else
            {{ Form::textarea('txtMedisch', '', ['id'=>'txtMedisch','oninput'=>'this.className','placeholder'=>'Niet verplicht'])}}
            @endif
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12 float-right">
            <a class = "btn btn-secondary form-control col-sm-2 mb-4 mt-2" href="/user/form/step-2">Vorige</a>
            {{ Form::submit('Registreer',['class' => 'btn btn-primary form-control col-sm-2 mb-4 mt-2 ']) }}
        </div>
    </div>
    {{ Form::close() }}
</div>

@endsection