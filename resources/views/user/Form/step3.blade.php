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
            <div class="input-group">
                {{ Form::text('txtEmail', $sEnteredEmail, ['required','id'=>'txtEmail','oninput'=>'this.className', 'class' => 'mb-2 form-control ', 'placeholder' => 'voornaam.achternaam'])}}
                <div class="input-group-append">
                    <span class="form-control">@</span>
                </div>
                @if($sEmailExtension == 'student.ucll.be' || $sEmailExtension == 'student.ucll.be')
                    {{ Form::text('txtEmailExtension', $sEmailExtension, ['required', 'class' => 'form-control', 'readonly']) }}
                @else
                    {{ Form::text('txtEmailExtension', $sEmailExtension, ['required', 'class' => 'form-control']) }}
                @endif
            </div>
        </div>
        <div class="form-group col-md-4">
            <label class="form-label">GSM-nummer*</label>
            {{ Form::text('txtGsm', $sEnteredMobile, ['required', 'id'=>'txtGsm','oninput'=>'this.className', 'class' => 'mb-2 form-control '])}}
        </div>
    </div>
    <div class="form-row border-bottom pt-2">
        <div class="form-group col-md-6">
            <label class="form-label">Noodnummer 1*</label>
            {{ Form::text('txtNoodnummer1', $sEnteredEmergency1, ['required', 'id'=>'txtNoodnummer1','oninput'=>'this.className', 'class' => 'mb-2 form-control '])}}
        </div>

        <div class="form-group col-md-6">
            <label class="form-label">Noodnummer 2</label>
            {{ Form::text('txtNoodnummer2', $sEnteredEmergency2, ['id'=>'txtNoodnummer2','oninput'=>'this.className', 'class' => 'mb-2 form-control '])}}
        </div>
    </div>
    <h2 class="my-2 pb-2 border-bottom border-dark">Medische gegevens</h2>
    <div class="form-row border-bottom pt-2">
        <div class="form-group col-md-12">
        <label class="form-label">Heeft u een operatie gehad in het afgelopen jaar of andere medische aandoening? (Allergie, ziekte, ...)</label><br>
        <div>
            {{ Form::radio('radioMedisch', '1', $bCheckedMedicalCondition,['id'=>'radioMedisch','oninput'=>'this.className'])}}
            Ja
            {{ Form::radio('radioMedisch', '0', !$bCheckedMedicalCondition, ['id'=>'radioMedisch','oninput'=>'this.className'])}}
            Nee
        </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12">
        <label class="formLabel">Medische gegevens die belangrijk zijn voor begeleiders:</label>
            {{ Form::textarea('txtMedisch', $sEnteredMedicalCondition, ['id'=>'txtMedisch','oninput'=>'this.className','placeholder'=>'Niet verplicht'])}}
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-12 float-right">
            <button type="submit" class="btn" name="back" value="back">Vorige</button>
            <button type="submit" class="btn btn-primary" name="next" value="next">Registreer</button>
        </div>
    </div>
    {{ Form::close() }}
</div>

@endsection