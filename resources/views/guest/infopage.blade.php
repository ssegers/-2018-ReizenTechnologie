@extends('layouts.app')

@section('content')
    <div class="content-center">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        {!!$oContent->content!!}
    </div>
@endsection