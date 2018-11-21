@extends('layouts.app')

@section('content')
    @if($aPages->type=="pdf")
        <div class="embed-responsive embed-responsive-4by3">
            <embed class="embed-responsive-item" id="preview" src="{{$aPages->content}}" type='application/pdf'>
        </div>
    @else
        <div class="content-center">
            {!!$aPages->content!!}
        </div>
    @endif
@endsection