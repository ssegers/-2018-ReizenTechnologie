@extends('layouts.app')

@section('content')
    <div class="content-center">
        <embed class="embed-responsive-item" id="preview" src="{{$aPdfPages->content}}" type='application/pdf'>
    </div>
@endsection