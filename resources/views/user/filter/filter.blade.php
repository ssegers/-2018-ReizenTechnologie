@extends('layouts.app')

@section('content')
        @foreach ($aUserData as $oUserData)
            {{ $oUserData->traveller_id }}
        @endforeach
    {{ $aUserData->links() }}
@endsection

=======
@section('style')
    <style>

    </style>
>>>>>>> 8f65801c78637ac4d4b4e1fc2d6d1133ee6fdaa3
@endsection

@section('content')

@endsection

