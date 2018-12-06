@extends('layouts.app')

@section('content')

    <div class="container bg-white rounded shadow-sm">
    {{ Form::open(array('action' => 'RegisterController@step1', 'method' => 'post')) }}
    {{ csrf_field() }}

    <h2 class="my-2 pb-2 border-bottom border-dark">Basisgegevens</h2>
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
            <div class="form-group col-md-6">
                <label for="dropReis" class="form-label ">Reis*</label>
                {{ Form::select('dropReis', $aTrips, $iSelectedTripId ,['id'=>'dropReis', 'placeholder' => 'Selecteer een reis','oninput'=>'this.className', 'class' => 'mb-2 form-control '])}}
            </div>
            <div class="form-group col-md-6">
                <label for="txtStudentNummer" class="form-label ">Studentnummer*</label>
                {{ Form::text('txtStudentNummer', $sEnteredUsername, ['required','id'=>'txtStudentnummer','oninput'=>'this.className', 'class' => ' mb-2 form-control'])}}
            </div>
        </div>
        <div class="form-row pt-2">
            <div class="form-group col-md-6">
                <label class="form-label  ">Opleiding*</label>
                {{ Form::select('dropOpleiding',  $aStudies, $iSelectedStudyId , [ 'data-dependent' => 'dropAfstudeerrichtingen', 'id'=>'dropOpleiding', 'placeholder' => 'Selecteer een opleiding','oninput'=>'this.className', 'class' => 'cascadingMajor mb-2 form-control'])}}
            </div>
            <div class="form-group col-md-6">
                <label class="form-label ">Afstudeerrichting*</label>
                {{ Form::select('dropAfstudeerrichtingen', $aMajors, $iSelectedMajorId ,['id'=>'dropAfstudeerrichtingen','oninput'=>'this.className', 'class' => 'mb-2 form-control'])}}
            </div>
        </div>
        {{ Form::submit('Volgende',['class' => 'btn btn-primary form-control col-sm-2 mb-4 mt-2 ']) }}
        {{ Form::close() }}
    </div>
    <script src="{{ URL::asset('/js/cascadingDropDownStudyMajors.js') }}"></script>

@endsection