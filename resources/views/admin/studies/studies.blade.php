@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xs-6">
            <div class="field field-study">
                {{ $aMajors }}
            </div>
        </div>
        <div class="col-xs-6">
            <div class="field field-study">
                {{ $aStudies }}
            </div>
        </div>
    </div>
@endsection