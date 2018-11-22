@extends('layouts.admin')

@section('content')
    <div id="alert" role="alert"></div>
    @csrf
    <div id="messages"></div>
    <div class="row">
        <div class="col-sm">
            <h2>Richtingen</h2>
        </div>
        <div class="col-sm">
            <h2>Afstudeerrichtingen</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <select class="form-control" id="studySelect"></select>
        </div>
        <div class="col-sm">
            <ul id="majorList"></ul>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <label for="studyInput">Niewe richting toevoegen</label>
            <input class="form-control" id="studyInput" type="text">
            <button class="form-control" id="studyAdd">Voeg toe</button>
        </div>
        <div class="col-sm">
            <label for="majorInput">Niewe afstudeerrichting toevoegen</label>
            <input class="form-control" id="majorInput" type="text">
            <button class="form-control" id="majorAdd">Voeg toe</button>
        </div>
    </div>

    <style>
        #studySelect {
            /*margin: 2em 0;*/
        }
        #majorList {
            background-color: white;
            /*height: calc(100% - 4em);*/
            height: 100%;
            border: 1px solid lightgrey;
            border-radius: 4px;
            /*margin: 2em 0;*/
        }
    </style>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/cascading-studies.js') }}"></script>
@endsection