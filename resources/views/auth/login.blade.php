@extends('layouts.app')
@section('title') <title>Login</title>@endsection
@section('content')
    <div class="container">
        <h1>Log in</h1>

        @if(session()->has('message'))
            <div class="alert alert-danger">
                {{ session()->get('message') }}
            </div>
        @endif

        {{ Form::open(array('action' => 'AuthController@login', 'method' => 'post')) }}
            {{ csrf_field() }}

            <div class="form-group">
                <label>Email: </label>
                <input type="text" class="form-control" id="username" name="username">
            </div>

            <div class="form-group">
                <label>Password: </label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

        {{ Form::submit('Volgende',['class' => 'btn btn-primary form-control col-sm-2 mb-4 mt-2 ']) }}
        {{ Form::close() }}
    </div>
@endsection()