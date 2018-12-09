@extends('layouts.app')

@section('content')
    <br>
    <div class="container col-md-4 background-white" style="padding-bottom: 15px; border-radius: 10px;">
        @if(session()->has('message'))
            <div class="alert alert-danger">
                {{ session()->get('message') }}
            </div>
        @endif

        {{ Form::open(array('action' => 'AuthController@ShowEmailPost', 'method' => 'post')) }}
        {{ csrf_field() }}
        <div class="form-group col-md-12">
            <label>Email: </label>
            <input type="text" class="form-control" id="email" name="email">
        </div>
        <hr/>
        {{ Form::submit('Volgende',['class' => 'btn btn-primary form-control mb-12 ']) }}
        {{ Form::close() }}
    </div>
    </div>
@endsection()