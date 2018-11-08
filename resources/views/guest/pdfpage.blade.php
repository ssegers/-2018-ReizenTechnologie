@extends('layouts.app')

@section('content')
    <div class="content-center">
        <embed style="margin: auto; display: block;" src="/storage/upload/{{$aPdfPages->content}}" type="application/pdf" width="90%" class="responsive" height="600px" />
    </div>
@endsection