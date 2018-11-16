@extends('layouts.app')

@section('content')
    <div class="embed-responsive embed-responsive-4by3">
        <embed class="embed-responsive-item" id="preview" src="{{$aPdfPages->content}}" type='application/pdf'>
    </div>
@endsection