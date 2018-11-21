@extends('layouts.admin')

@section('content')
    <div id="alert" role="alert"></div>
    @csrf
    <div id="messages"></div>
    <div class="row">
        <div class="col-xs-6">
            <select id="studySelect"></select>
            <div>
                <input id="studyInput" type="text">
                <button id="studyAdd">Add</button>
            </div>
        </div>
        <div class="col-xs-6">
            <ul id="majorList"></ul>
            <div>
                <input id="majorInput" type="text">
                <button id="majorAdd">Add</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/cascading-studies.js') }}"></script>
@endsection