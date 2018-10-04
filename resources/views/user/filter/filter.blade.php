@extends('layouts.app')

@section('content')

    @foreach ($aUserData as $oUserData)
        {{ $oUserData->traveller_id }}
    @endforeach

    {{ $aUserData->links() }}

@endsection
@section('style')
    <style>

    </style>
@endsection

